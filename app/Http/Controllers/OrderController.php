<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
class OrderController extends Controller
{
    /**
     * Create a new order from the cart items.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
        try {
            // Get the authenticated employer
            $employerId = Auth::guard('employer')->id();
            if (!$employerId) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để thực hiện thao tác này.'], 401);
            }

            // Get all cart items for the employer
            $cartItems = Cart::with('service')->where('employer_id', $employerId)->get();

            // Check if cart is empty
            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Giỏ hàng của bạn đang trống.'], 400);
            }

            // Calculate total price
            $totalPrice = $cartItems->sum('total_price');

            DB::beginTransaction();

            // Create a new order
            $order = Order::create([
                'employer_id' => $employerId,
                'order_key' => Order::generateOrderKey(),
                'status' => 'Chưa thanh toán',
                'total_price' => $totalPrice,
            ]);

            // Create order details for each cart item
            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'service_id' => $cartItem->service_id,
                    'quantity' => $cartItem->quantity,
                    'number_of_weeks' => $cartItem->number_of_weeks,
                    'number_of_active'=> $cartItem->quantity,
                    'price' => $cartItem->service->price,
                    'total_price' => $cartItem->total_price,
                ]);
            }

            // Clear the cart
            Cart::where('employer_id', $employerId)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đặt hàng thành công. Vui lòng thanh toán để hoàn tất đơn hàng.',
                'order_key' => $order->order_key,
                'redirect' => route('employer.orders.show', $order->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employerId = Auth::guard('employer')->id();
        $orders = Order::with('orderDetails.service')
            ->where('employer_id', $employerId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
 public function show($id)
{
    $employerId = Auth::guard('employer')->id();
    $order = Order::with('orderDetails.service')
        ->where('id', $id)
        ->firstOrFail();

    if ($order->employer_id != $employerId) {
        throw new AccessDeniedHttpException('Bạn không có quyền truy cập đơn hàng này.');
    }

    // Lấy danh sách ngân hàng đang hoạt động
    $banks = Bank::where('status', '1')->get();

    // Tỷ giá giả định: 1 USD = 24,000 VND
    $exchangeRate = 25000;
    $usdTotal = $order->total_price / $exchangeRate;

    return view('employer.orders.show', compact('order', 'banks', 'usdTotal'));
}


    /**
     * Update the specified order status to paid.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws AccessDeniedHttpException
     */
    public function markAsPaid(Request $request, $id)
    {
        try {
            $employerId = Auth::guard('employer')->id();
            $order = Order::where('id', $id)->firstOrFail();

            // Check if the order belongs to the authenticated employer
            if ($order->employer_id != $employerId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không có quyền truy cập đơn hàng này.'
                ], Response::HTTP_FORBIDDEN);
            }

            $order->status = 'Đã thanh toán';
            $order->save();

            return response()->json(['success' => true, 'message' => 'Đơn hàng đã được đánh dấu là đã thanh toán.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
}
