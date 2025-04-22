<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $employerId = Auth::guard('employer')->id();
        $newsList = News::where('employer_id', $employerId)->get();

        return view('employer.news.index', compact('newsList'));
    }

    public function create()
    {
        return view('employer.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'website' => 'nullable|url',
        ]);

        $employer = Auth::guard('employer')->user();

        // Kiểm tra xem employer có gói 'Tin tức' không
        $orderDetail = OrderDetail::whereHas('order', function ($query) use ($employer) {
            $query->where('employer_id', $employer->id)
                ->where('status', 'Đã thanh toán');
        })
            ->whereHas('service', function ($query) {
                $query->where('name', 'Tin tức');
            })
            ->where('number_of_active', '>', 0)
            ->whereDate('expiring_date', '>=', Carbon::today())
            ->orderBy('expiring_date')
            ->first();

        if (!$orderDetail) {
            return redirect()->back()->with('error', 'Bạn không có gói Tin nổi bật đang hoạt động để đăng tin tức.');
        }

        // Trừ số lượng active
        $orderDetail->decrement('number_of_active');

        $data = $request->all();
        $data['employer_id'] = $employer->id;
        $data['order_id'] = $orderDetail->order_id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('employer.news.index')->with('success', 'Thêm tin tức thành công!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        if ($news->employer_id != Auth::guard('employer')->id()) {
            abort(403);
        }

        return view('employer.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        if ($news->employer_id != Auth::guard('employer')->id()) {
            abort(403);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('employer.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->employer_id != Auth::guard('employer')->id()) {
            abort(403);
        }

        $news->delete();

        return redirect()->back()->with('success', 'Xóa tin tức thành công!');
    }
}
