<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Employer;
use App\Models\Genre;
use App\Models\JobPosting;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployerManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employer-list|employer-create|employer-edit|employer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:employer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employer-delete', ['only' => ['destroy']]);
    }

   public function index()
{
    $user = Auth::user();

    // Nếu là admin thì hiển thị toàn bộ, nếu không thì chỉ hiển thị của chính họ
    if ($user->roles()->where('id', 1)->exists()) {
        $employers = Employer::with(['jobPostings', 'gallery'])->get();
    } else {
        $employers = Employer::with(['jobPostings', 'gallery'])
            ->where('user_id', $user->id)
            ->get();
    }

    return view('admin.employers.index', compact('employers'));
}

   public function indexJobPosting()
{
    $user = Auth::user();

    $jobPostings = JobPosting::with(['employer', 'categories', 'genres', 'countries'])
        ->whereHas('genres', function ($q) {
            $q->where('slug', 'viec-lam-moi');
        })
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->get();

    return view('admin.employers.index-job-posting', compact('jobPostings'));
}

public function indexBasic()
{
    $user = Auth::user();

    $jobPostings = JobPosting::with(['employer', 'categories', 'genres', 'countries'])
        ->where('service_type', 'Tin cơ bản')
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->get();

    return view('admin.employers.index-job-basic', compact('jobPostings'));
}


public function indexOutstanding()
{
    $user = Auth::user();

    $jobPostings = JobPosting::with(['employer', 'categories', 'genres', 'countries'])
        ->where('service_type', 'Tin nổi bật')
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->get();

    return view('admin.employers.index-job-outstanding', compact('jobPostings'));
}


public function indexSpecial()
{
    $user = Auth::user();

    $jobPostings = JobPosting::with(['employer', 'categories', 'genres', 'countries'])
        ->where('service_type', 'Tin đặc biệt')
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->get();

    return view('admin.employers.index-job-special', compact('jobPostings'));
}

    public function show($id)
    {
        $employer = Employer::findOrFail($id);
        $jobPostings = JobPosting::where('employer_id', $id)
            ->with(['categories', 'genres', 'countries'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.employers.show', compact('employer', 'jobPostings'));
    }

    public function edit(Employer $employer)
    {
        $user = Auth::user();
        if ($user->roles()->where('id', 1)->exists() || $employer->user_id == $user->id) {
            $users = User::all(); // Lấy danh sách tất cả user
             $categories = Category::where('status', 'active')->get();
        $genres = Genre::where('status', 'active')->get();
            return view('admin.employers.edit', compact('employer', 'categories', 'genres', 'users'));
        }
        abort(403, 'Bạn không có quyền truy cập.');
    }


    public function editJobPosting($employerId, $jobPostingId)
    {
        $employer = Employer::findOrFail($employerId);
          $user = Auth::user();

    if (!$user->roles()->where('id', 1)->exists() && $employer->user_id != $user->id) {
        abort(403, 'Bạn không có quyền chỉnh sửa bài đăng này.');
    }
        $jobPosting = JobPosting::where('employer_id', $employerId)
            ->with(['categories', 'genres', 'countries'])
            ->findOrFail($jobPostingId);

        $categories = Category::all();
        $countries = Country::all();
        $genres = Genre::all();

        return view('admin.employers.edit-job-posting', compact(
            'employer',
            'jobPosting',
            'categories',
            'countries',
            'genres'
        ));
    }

    public function updateJobPosting(Request $request, $employerId, $jobPostingId)
    {
        $jobPosting = JobPosting::where('employer_id', $employerId)->findOrFail($jobPostingId);
  $user = Auth::user();
    $employer = Employer::findOrFail($employerId);

    if (!$user->roles()->where('id', 1)->exists() && $employer->user_id != $user->id) {
        abort(403, 'Bạn không có quyền cập nhật bài đăng này.');
    }
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime,intern,freelance',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'required|string',
            'experience' => 'required|string',
            'skills_required' => 'required|string',
            'closing_date' => 'required|date',
            'application_email_url' => 'required|email',
            'status' => 'required|in:active,inactive,pending,rejected',
            'categories' => 'required|array',
            'countries' => 'required|array',
            'genres' => 'nullable|array'
        ]);

        $jobPosting->update($request->except(['categories', 'countries', 'genres']));

        // Sync relationships
        $jobPosting->categories()->sync($request->categories);
        $jobPosting->countries()->sync($request->countries);
        $jobPosting->genres()->sync($request->genres);

        return redirect()->route('manage.employers.show', $employerId)
            ->with('success', 'Bài đăng tuyển dụng đã được cập nhật thành công');
    }

    public function update(Request $request, Employer $employer)
    {
        $user = Auth::user();
        if (!$user->roles()->where('id', 1)->exists() && $employer->user_id != $user->id) {
            abort(403, 'Bạn không có quyền chỉnh sửa.');
        }
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employers,email,' . $employer->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'scale' => 'required|string|max:100',
            'mst' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'detail' => 'nullable|string',
            'status' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
             'isVerifyCompany' => 'boolean',
            'user_id' => 'nullable|exists:users,id',
             'categories' => 'nullable|array',
    'categories.*' => 'exists:categories,id',
    'genres' => 'nullable|array',
    'genres.*' => 'exists:genres,id',
        ]);

        // Handle boolean fields
        $booleanFields = [
            'status',
            'isVerifyCompany',
        ];

        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field);

            // Kiểm tra nếu giá trị thay đổi thì cập nhật timestamp
            if ($employer->$field != $validated[$field]) {
                $validated[$field . '_updated_at'] = now();
            }
        }
        if ($user->roles()->where('id', 1)->exists() && $request->filled('user_id')) {
            $validated['user_id'] = $request->user_id;
        } else {
            // Đảm bảo giữ nguyên user_id nếu không phải admin
            $validated['user_id'] = $employer->user_id;
        }
        // Xử lý logo nếu có
        if ($request->hasFile('logo')) {
            if ($employer->avatar) {
                Storage::delete($employer->avatar);
            }
            $validated['logo'] = $request->file('logo')->store('employers/logos', 'public');
        }

        // Thêm slug
        $validated['slug'] = Str::slug($validated['company_name']);


        // Cập nhật employer với tất cả dữ liệu đã validate
        $employer->update($validated);
// Đồng bộ categories và genres
$employer->categories()->sync($request->input('categories', []));
$employer->genres()->sync($request->input('genres', []));
        return redirect()->route('manage.employers.edit', $employer)
            ->with('success', 'Thông tin nhà tuyển dụng đã được cập nhật thành công.');
    }
   public function destroy(Employer $employer)
{
    $user = Auth::user();

    // Chỉ cho admin hoặc người tạo employer được phép xóa
    if ($user->roles()->where('id', 1)->exists() || $employer->user_id == $user->id) {
        try {
            $employerName = $employer->company_name;
            $employer->delete();

            return redirect()->route('manage.employers.index')
                ->with('success', "Đã xóa nhà tuyển dụng \"$employerName\" thành công");
        } catch (\Exception $e) {
            return redirect()->route('manage.employers.index')
                ->with('error', 'Không thể xóa nhà tuyển dụng. Vui lòng thử lại sau.');
        }
    }

    // Nếu không có quyền thì trả về lỗi 403
    abort(403, 'Bạn không có quyền xóa nhà tuyển dụng này.');
}

 public function orders()
{
    $user = Auth::user();

    $orders = Order::with(['employer', 'orderDetails.service'])
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('admin.orders.index', compact('orders'));
}


   public function showOrder($id)
{
    $user = Auth::user();

    $order = Order::with(['employer', 'orderDetails.service'])
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}
public function updateOrderStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Đã thanh toán,Chưa thanh toán',
    ]);

    $user = Auth::user();

    DB::beginTransaction();
    try {
        $order = Order::with('employer')->findOrFail($id);

        // Chỉ cho phép nếu là admin hoặc chủ sở hữu
        if (!$user->roles()->where('id', 1)->exists() && $order->employer->user_id !== $user->id) {
            abort(403, 'Bạn không có quyền cập nhật đơn hàng này.');
        }

        $order->status = $request->status;
        $order->save();

        // Nếu trạng thái là "Đã thanh toán", cập nhật ngày hết hạn
        if ($request->status == 'Đã thanh toán') {
            $orderDate = Carbon::now();
            foreach ($order->orderDetails as $detail) {
                $expiringDate = $orderDate->copy()->addWeeks($detail->number_of_weeks);
                $detail->expiring_date = $expiringDate;
                $detail->save();
            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
    }
}


    /**
     * Update the order detail's number of active.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrderDetailActive(Request $request, $id)
    {
        $request->validate([
            'number_of_active' => 'required|integer|min:0',
        ]);

        try {
            $orderDetail = OrderDetail::findOrFail($id);

            // Ensure number_of_active doesn't exceed quantity
            $numberActive = min($request->number_of_active, $orderDetail->quantity);

            $orderDetail->number_of_active = $numberActive;
            $orderDetail->save();

            return redirect()->back()->with('success', 'Số lượng tin đang hoạt động đã được cập nhật.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }


  public function orderDetails()
{
    $user = Auth::user();

    $orderDetails = OrderDetail::with(['order.employer', 'service'])
        ->when(!$user->roles()->where('id', 1)->exists(), function ($query) use ($user) {
            $query->whereHas('order.employer', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return view('admin.order_details.index', compact('orderDetails'));
}

}
