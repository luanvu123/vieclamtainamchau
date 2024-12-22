<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmployerProfileController extends Controller
{
    public function edit()
    {
        $employer = Auth::guard('employer')->user();
        $categories = Category::where('status', 'active')->get();
        $genres = Genre::where('status', 'active')->get();
        return view('employer.profile.edit', compact('employer', 'categories', 'genres'));
    }

   public function updateCompany(Request $request)
{
    // Xác thực dữ liệu
    $request->validate([
        'mst' => 'nullable|string|max:255',
        'company_name' => 'required|string|max:255',
        'scale' => 'nullable|string',
        'map' => 'nullable|string',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:categories,id',
        'genres' => 'nullable|array',
        'genres.*' => 'exists:genres,id',
        'business_license' => 'nullable|file|mimes:doc,docx,pdf|max:10240',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'gallery_captions.*' => 'nullable|string|max:255',
        'gallery_sort_orders.*' => 'nullable|integer|min:0',
        'delete_gallery.*' => 'nullable|integer|exists:company_galleries,id', // Kiểm tra ID ảnh hợp lệ
    ]);

    // Lấy employer đang đăng nhập
    $employer = Auth::guard('employer')->user();

    // Cập nhật các thông tin
    $employer->update([
        'mst' => $request->mst,
        'company_name' => $request->company_name,
        'slug' => Str::slug($request->company_name),
        'scale' => $request->scale,
        'map' => $request->map,
    ]);

    // Cập nhật quan hệ categories và genres
    if ($request->has('categories')) {
        $employer->categories()->sync($request->categories);
    }

    if ($request->has('genres')) {
        $employer->genres()->sync($request->genres);
    }

    // Xóa ảnh được chọn
    if ($request->filled('delete_gallery')) {
        $deleteGalleryIds = $request->input('delete_gallery');
        $imagesToDelete = $employer->gallery()->whereIn('id', $deleteGalleryIds)->get();

        foreach ($imagesToDelete as $image) {
            // Xóa file khỏi storage
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Xóa bản ghi khỏi database
            $image->delete();
        }
    }

    // Thêm ảnh mới vào gallery
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $index => $image) {
            $imagePath = $image->store('company_galleries', 'public');
            $caption = $request->gallery_captions[$index] ?? null;
            $sortOrder = $request->gallery_sort_orders[$index] ?? 0;

            $employer->gallery()->create([
                'image_path' => $imagePath,
                'caption' => $caption,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Thông tin công ty đã được cập nhật.');
}


    public function updateInfo(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $employer = Auth::guard('employer')->user();

        // Cập nhật avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $employer->avatar = $avatarPath;
        }

        // Cập nhật các thông tin khác
        $employer->name = $request->input('name');
        $employer->phone = $request->input('phone');
        $employer->address = $request->input('address');

        // Cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $employer->password = Hash::make($request->input('password'));
        }

        $employer->save();

        return redirect()->route('employer.profile.edit')->with('success', 'Cập nhật thông tin thành công.');
    }
    public function update(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'business_license' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'detail' => 'nullable|string',
            'scale' => 'nullable|string|max:255',
            'mst' => 'nullable|string|max:50',
        ]);

        $data = $request->except(['logo', 'business_license']);
        $data['slug'] = Str::slug($request->company_name);

        if ($request->hasFile('logo')) {
            if ($employer->logo) {
                Storage::delete($employer->logo);
            }
            $data['logo'] = $request->file('logo')->store('employer/logos');
        }

        if ($request->hasFile('business_license')) {
            if ($employer->business_license) {
                Storage::delete($employer->business_license);
            }
            $data['business_license'] = $request->file('business_license')->store('employer/licenses');
        }

        $employer->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
