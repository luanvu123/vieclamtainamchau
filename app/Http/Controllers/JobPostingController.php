<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Bank;
use App\Models\Candidate;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\JobPosting;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusChanged;
use App\Models\Notification;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderDetail;
use App\Models\Typeservice;

class JobPostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
    }

    public function findCandidate()
    {
        $employer = Auth::guard('employer')->user();

        // Lọc các orderDetails có service.name = 'Tìm ứng viên', expiring_date hợp lệ, order.status = 'Đã thanh toán'
        $validOrderDetails = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Tìm ứng viên');
            })
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->get();

        $candidates = Candidate::where('is_public', 1)->get();

        return view('employer.job-posting.find_candidate', compact('candidates', 'validOrderDetails'));
    }



    public function index(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        $query = JobPosting::with('genres')
            ->where('employer_id', $employer->id)
            ->whereHas('genres', function ($q) {
                $q->where('slug', 'viec-lam-moi');
            });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobPostings = $query->get();

        return view('employer.job-posting.index', compact('jobPostings'));
    }
    public function indexExport(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        $query = JobPosting::with('genres')
            ->where('employer_id', $employer->id)
            ->whereHas('genres', function ($q) {
                $q->where('slug', 'xuat-khau-lao-dong');
            });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobPostings = $query->get();

        return view('employer.job-posting.export', compact('jobPostings'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get();
        $genres = Genre::where('status', 'active')->get();
        $employer = Auth::guard('employer')->user();

        $basicServiceDetails = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Tin cơ bản');
            })
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->where('number_of_active', '>', 0)
            ->with(['service'])
            ->get();
        $hotServiceDetails = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Tin nổi bật');
            })
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->where('number_of_active', '>', 0)
            ->with(['service'])
            ->get();
        $specialServiceDetails = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Tin đặc biệt');
            })
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->where('number_of_active', '>', 0)
            ->with(['service'])
            ->get();


        return view('employer.job-posting.create', compact(
            'categories',
            'countries',
            'employer',
            'genres',
            'basicServiceDetails',
            'hotServiceDetails',
            'specialServiceDetails'
        ));
    }
    public function store(Request $request)
    {
        $employer = Auth::guard('employer')->user();
        $requiredFields = [
        'avatar', 'mst', 'address', 'scale', 'detail', 'phone','map'
    ];

    foreach ($requiredFields as $field) {
        if (empty($employer->$field)) {
            return redirect()->back()
                ->with('error', 'Vui lòng cập nhật đầy đủ thông tin công ty trước khi tạo tin tuyển dụng.');
        }
    }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime,intern,freelance',
            'age_range' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'closing_date' => 'required|date',
            'salary' => 'required|string|max:50',
            'experience' => 'required|in:Không yêu cầu,1 năm,2 năm,3 năm,4 năm,5 năm,5+ năm',
            'rank' => 'required|string|max:100',
            'number_of_recruits' => 'required|integer',
            'sex' => 'required|string|max:50',
            'skills_required' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'countries' => 'required|array',
            'countries.*' => 'exists:countries,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'service_type' => 'required|in:Tin cơ bản,Tin nổi bật,Tin đặc biệt',
        ]);

        $orderDetail = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) use ($validated) {
                $query->where('name', $validated['service_type']);
            })
            ->where('number_of_active', '>', 0)
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->orderBy('expiring_date')
            ->first();

        if ($orderDetail) {
            $orderDetail->decrement('number_of_active');

            $jobPosting = JobPosting::create([
                'employer_id' => $employer->id,
                'order_id' => $orderDetail->order_id,
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'type' => $validated['type'],
                'age_range' => $validated['age_range'],
                'location' => $validated['location'],
                'description' => $validated['description'],
                'closing_date' => $validated['closing_date'],
                'salary' => $validated['salary'],
                'experience' => $validated['experience'],
                'rank' => $validated['rank'],
                'number_of_recruits' => $validated['number_of_recruits'],
                'sex' => $validated['sex'],
                'skills_required' => $validated['skills_required'],
                'service_type' => $validated['service_type']
            ]);
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy gói dịch vụ hợp lệ để đăng tin.');
        }



        if (!empty($validated['categories'])) {
            $jobPosting->categories()->sync($validated['categories']);
        }

        if (!empty($validated['countries'])) {
            $jobPosting->countries()->sync($validated['countries']);
        }
        if (!empty($validated['genres'])) {
            $jobPosting->genres()->sync($validated['genres']);
        }
        return redirect()->route('employer.job-posting.index')
            ->with('success', 'Bài đăng tuyển dụng đã được tạo thành công.');
    }
    public function edit($id)
    {
        $jobPosting = JobPosting::with(['categories', 'countries', 'genres'])->findOrFail($id);
        $employer = Auth::guard('employer')->user();

        // Check if the job posting belongs to the authenticated employer
        if ($jobPosting->employer_id != $employer->id) {
            return redirect()->route('employer.job-posting.index')
                ->with('error', 'Bạn không có quyền chỉnh sửa bài đăng này');
        }


        $categories = Category::where('status', 'active')->get();
        $countries = Country::where('status', 'active')->get();
        $genres = Genre::where('status', 'active')->get();

        return view('employer.job-posting.edit', compact(
            'jobPosting',
            'employer',
            'categories',
            'countries',
            'genres'
        ));
    }

    public function update(Request $request, $id)
    {
        $employer = Auth::guard('employer')->user();
        $jobPosting = JobPosting::findOrFail($id);

        if ($jobPosting->employer_id != $employer->id) {
            return redirect()->route('employer.job-posting.index')
                ->with('error', 'Bạn không có quyền cập nhật bài đăng này');
        }
        // Không cho chỉnh sửa nếu trạng thái là active
        if ($jobPosting->status === 'active') {
            return redirect()->back()
                ->with('error', 'Tin đăng đang hoạt động và không thể chỉnh sửa');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime,intern,freelance',
            'age_range' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:50',
            'rank' => 'required|string|max:50',
            'number_of_recruits' => 'required|integer|min:1',
            'sex' => 'required|string|max:20',
            'skills_required' => 'required|string',
            'description' => 'required|string',
            'closing_date' => 'required|date|after:today',
            'salary' => 'required|string|max:100',
            'categories' => 'required|array|exists:categories,id',
            'countries' => 'required|array|exists:countries,id',
            'genres' => 'required|array|exists:genres,id'
        ]);

        try {
            DB::beginTransaction();

            // Update job posting
            $jobPosting->update($validated);

            // Sync relationships
            $jobPosting->categories()->sync($request->categories);
            $jobPosting->countries()->sync($request->countries);
            $jobPosting->genres()->sync($request->genres);

            DB::commit();

            return redirect()->route('employer.job-posting.index')
                ->with('success', 'Cập nhật bài đăng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật bài đăng: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $jobPosting = JobPosting::findOrFail($id);

            // Kiểm tra xem bài đăng có thuộc về nhà tuyển dụng đang đăng nhập hay không
            if ($jobPosting->employer_id != auth('employer')->id()) {
                return redirect()->route('employer.job-posting.index')
                    ->with('error', 'Bạn không có quyền xóa bài đăng này.');
            }

            // Xóa bài đăng
            $jobPosting->delete();

            return redirect()->route('employer.job-posting.index')
                ->with('success', 'Bài đăng tuyển dụng đã được xóa thành công.');
        } catch (\Exception $e) {
            return back()->with('error', 'Đã xảy ra lỗi khi xóa bài đăng: ' . $e->getMessage());
        }
    }

    public function viewApplications($id)
    {
        $employer = Auth::guard('employer')->user();
        $jobPosting = JobPosting::where('employer_id', $employer->id)
            ->findOrFail($id);

        // Lấy gói "Xem thông tin ứng viên" của employer
        $orderDetail = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Xem thông tin ứng viên');
            })
            ->where('number_of_active', '>', 0)
            ->whereDate('expiring_date', '>=', now())
            ->first();

        $hasViewInfoPackage = $orderDetail ? true : false;

        $applications = Application::with([
            'candidate',
            'candidate.skills',
            'candidate.softSkills',
            'candidate.languages',
            'candidate.experiences',
            'candidate.educations',
            'candidate.certificates'
        ])
            ->where('job_posting_id', $id)
            ->whereIn('approve_application', ['Đã duyệt', 'Nộp lại'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job-posting.applications', compact('jobPosting', 'applications', 'hasViewInfoPackage'));
    }
    public function viewInfo(Request $request, Application $application)
    {
        $employer = Auth::guard('employer')->user();

        $orderDetail = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Xem thông tin ứng viên');
            })
            ->where('number_of_active', '>', 0)
            ->whereDate('expiring_date', '>=', now())
            ->first();

        if (!$orderDetail) {
            return response()->json(['message' => 'Bạn chưa mua gói hoặc đã hết lượt xem.'], 403);
        }

        DB::transaction(function () use ($orderDetail, $application) {
            $orderDetail->decrement('number_of_active');

            $application->order_id = $orderDetail->order_id;
            $application->save();
        });

        return response()->json([
            'phone' => $application->candidate->phone,
            'email' => $application->candidate->email,
            'cv_path' => asset('storage/' . $application->cv_path)
        ]);
    }

    private function createNotification($application, $status)
    {
        $jobTitle = $application->jobPosting->title;
        $companyName = $application->jobPosting->employer->company_name;

        $title = "Cập nhật trạng thái ứng tuyển";
        $message = "Đơn ứng tuyển của bạn cho vị trí {$jobTitle} tại {$companyName} đã được cập nhật thành " .
            ucfirst($status);

        Notification::create([
            'candidate_id' => $application->candidate_id,
            'title' => $title,
            'message' => $message,
            'type' => 'application_status',
            'link' => route('candidate.applications')
        ]);
    }
    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected'
        ]);

        $application = Application::findOrFail($id);

        // Kiểm tra nhà tuyển dụng có quyền cập nhật đơn này không
        if ($application->jobPosting->employer_id != Auth::guard('employer')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Danh sách trạng thái hợp lệ theo thứ tự
        $validTransitions = [
            'pending' => ['reviewed'],
            'reviewed' => ['accepted', 'rejected'],
            'accepted' => ['rejected'],
            'rejected' => [] // Không thể thay đổi trạng thái khi đã bị từ chối
        ];

        // Kiểm tra trạng thái có hợp lệ không
        if (!in_array($request->status, $validTransitions[$application->status])) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể cập nhật trạng thái ngược lại'
            ], 400);
        }

        // Cập nhật trạng thái
        $application->update(['status' => $request->status]);

        // Tạo thông báo
        $this->createNotification($application, $request->status);

        // Gửi email thông báo cho ứng viên
        Mail::to($application->candidate->email)->send(new ApplicationStatusChanged($application));

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công và đã gửi email thông báo'
        ]);
    }
    public function toggleSave($id)
    {
        $application = Application::findOrFail($id);

        // Verify employer owns this job posting
        if ($application->jobPosting->employer_id != Auth::guard('employer')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $application->saved = !$application->saved;
        $application->save();

        return response()->json([
            'success' => true,
            'saved' => $application->saved,
            'message' => $application->saved ? 'Đã lưu hồ sơ' : 'Đã bỏ lưu hồ sơ'
        ]);
    }

    public function savedApplications()
    {
        $employer = Auth::guard('employer')->user();
        $savedApplications = Application::with('candidate', 'jobPosting')
            ->whereHas('jobPosting', function ($query) use ($employer) {
                $query->where('employer_id', $employer->id);
            })
            ->where('saved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job-posting.saved-applications', compact('savedApplications'));
    }
    public function services()
    {


        $banks = Bank::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->get();

        $employerId = Auth::guard('employer')->id();
        $carts = Cart::getEmployerCart($employerId);

        $exchangeRate = 0.000042;
        $typeservices = Typeservice::with(['services.weeks'])
            ->where('status', true)
            ->get();

        return view('employer.job-posting.services', compact('typeservices', 'banks', 'carts', 'exchangeRate'));


    }

    public function removeFromCart($id)
    {
        $cart = Cart::where('id', $id)
            ->where('employer_id', Auth::guard('employer')->id())
            ->firstOrFail();

        $cart->delete();

        return response()->json(['success' => true, 'message' => 'Đã xoá dịch vụ khỏi giỏ hàng.']);
    }

    public function getCartCount()
    {
        $employerId = Auth::guard('employer')->user()->id;
        $cartCount = Cart::where('employer_id', $employerId)->sum('quantity');

        return response()->json([
            'cart_count' => $cartCount
        ]);
    }
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
            'number_of_weeks' => 'required|in:1,2,4',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $employerId = Auth::guard('employer')->id();

        // Kiểm tra xem có cart giống service_id và number_of_weeks hay không
        $cart = Cart::where('employer_id', $employerId)
            ->where('service_id', $validated['service_id'])
            ->where('number_of_weeks', $validated['number_of_weeks'])
            ->first();

        if ($cart) {
            // Nếu trùng cả service_id và number_of_weeks => gộp quantity
            $cart->quantity += $validated['quantity'];
            $cart->total_price = $service->price * $cart->quantity * $cart->number_of_weeks;
            $cart->save();
        } else {
            // Nếu number_of_weeks khác => tạo mới
            Cart::create([
                'employer_id' => $employerId,
                'service_id' => $validated['service_id'],
                'quantity' => $validated['quantity'],
                'number_of_weeks' => $validated['number_of_weeks'],
                'total_price' => $service->price * $validated['quantity'] * $validated['number_of_weeks'],
            ]);
        }

        $cartCount = Cart::where('employer_id', $employerId)->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Dịch vụ đã được thêm vào giỏ hàng',
            'cart_count' => $cartCount
        ]);
    }


    public function serviceActive()
    {
        $employer = Auth::guard('employer')->user();

        $orders = Order::with(['orderDetails.cart'])
            ->where('employer_id', $employer->id)
            ->where('status', 'Đã thanh toán')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employer.job-posting.service-active', compact('employer', 'orders'));
    }

    public function updateApplicationView(Request $request)
    {
        $application = Application::findOrFail($request->id);

        if ($application->status === 'pending') {
            $application->status = 'reviewed';
            $application->save();

            // Gửi email thông báo cho ứng viên
            Mail::to($application->candidate->email)->send(new ApplicationStatusChanged($application));

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công và đã gửi email thông báo'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không thể cập nhật trạng thái'
        ]);
    }
}
