<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertiseController extends Controller
{
    public function index()
    {
        $advertises = Advertise::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.advertises.index', compact('advertises'));
    }

    public function create()
    {
        return view('employer.advertises.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'content' => 'nullable',
        ]);

        $employer = Auth::guard('employer')->user();

        // Kiểm tra employer có gói "Quảng cáo"
        $orderDetail = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Quảng cáo');
            })
            ->where('number_of_active', '>', 0)
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->orderBy('expiring_date')
            ->first();

        if (!$orderDetail) {
            return redirect()->back()->with('error', 'Bạn không có gói Quảng cáo hợp lệ để tạo quảng cáo.');
        }

        $orderDetail->decrement('number_of_active');

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('advertises', 'public');
        }

        Advertise::create([
            'employer_id' => $employer->id,
            'order_id' => $orderDetail->order_id,
            'title' => $request->title,
            'image' => $path,
            'content' => $request->content,
        ]);

        return redirect()->route('employer.advertises.index')->with('success', 'Tạo quảng cáo thành công');
    }
    public function edit(Advertise $advertise)
    {
        $this->authorizeAdvertise($advertise);
        return view('employer.advertises.edit', compact('advertise'));
    }

    public function update(Request $request, Advertise $advertise)
    {
        $this->authorizeAdvertise($advertise);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'content' => 'nullable',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $advertise->image = $request->file('image')->store('advertises', 'public');
        }

        $advertise->update($request->only(['title', 'content', 'status']));

        return redirect()->route('employer.advertises.index')->with('success', 'Cập nhật quảng cáo thành công');
    }

    public function destroy(Advertise $advertise)
    {
        $this->authorizeAdvertise($advertise);
        $advertise->delete();
        return redirect()->route('employer.advertises.index')->with('success', 'Xóa quảng cáo thành công');
    }

    private function authorizeAdvertise($advertise)
    {
        if ($advertise->employer_id != Auth::guard('employer')->id()) {
            abort(403);
        }
    }
}
