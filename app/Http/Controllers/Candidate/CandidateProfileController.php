<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CandidateLanguageTraining;
use App\Models\Category;
use App\Models\CV;
use App\Models\JobPosting;
use App\Models\Language;
use App\Models\Notification;
use App\Models\Skill;
use App\Models\SoftSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CandidateProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate');
    }

  public function job($slug)
    {
        $jobPosting = JobPosting::where('slug', $slug)
            ->with('employer')
            ->firstOrFail();
        $jobPosting->increment('views');
        $orderJob = JobPosting::where('employer_id', $jobPosting->employer_id)
            ->where('slug', '!=', $slug)
            ->where('status', 'active')
            ->whereIn('service_type', ['Tin cơ bản','Tin nổi bật', 'Tin đặc biệt'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $categories = Category::where('status', 'active')->where('isHot', 0)->get();

        return view('pages.job', compact('jobPosting', 'categories', 'orderJob'));
    }
    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'title' => 'required|string|max:255',
        ]);

        $candidate = Auth::guard('candidate')->user();

        if ($candidate->cvs()->count() >= 3) {
            return back()->with('error', 'Bạn chỉ được tải lên tối đa 3 CV.');
        }

        $file = $request->file('cv');
        $filePath = $file->store('cvs', 'public');

        $cv = CV::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize() / 1024, // KB
            'is_template' => false,
            'is_public' => false,
        ]);

        $candidate->cvs()->attach($cv->id, [
            'is_primary' => false,
            'is_active' => true,
        ]);

        return back()->with('success', 'Tải lên CV thành công.');
    }
    public function deleteCV($id)
{
    $candidate = Auth::guard('candidate')->user();
    $cv = $candidate->cvs()->where('cv_id', $id)->first();

    if (!$cv) {
        return back()->with('error', 'Không tìm thấy CV hoặc bạn không có quyền.');
    }

    // Xoá file khỏi storage
    if (Storage::exists($cv->file_path)) {
        Storage::delete($cv->file_path);
    }

    // Xoá liên kết và bản ghi CV nếu cần
    $candidate->cvs()->detach($id);
    $cv->delete();

    return back()->with('success', 'CV đã được xóa thành công.');
}

    public function registerTraining(Request $request)
    {
        $candidateId = Auth::guard('candidate')->id();

        // Check nếu đã đăng ký
        $exists = CandidateLanguageTraining::where('candidate_id', $candidateId)
            ->where('language_training_id', $request->language_training_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Bạn đã đăng ký khóa học này rồi.');
        }

        CandidateLanguageTraining::create([
            'candidate_id' => $candidateId,
            'language_training_id' => $request->language_training_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Đăng ký thành công!');
    }
    public function notify()
    {
        $candidate = Auth::guard('candidate')->user();
        $notifications = Notification::where('candidate_id', $candidate->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('candidate.notify', compact('notifications'));
    }

    public function markNotificationAsRead($id)
    {
        $notification = Notification::where('candidate_id', Auth::guard('candidate')->id())
            ->findOrFail($id);

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function clearAllNotifications()
    {
        Notification::where('candidate_id', Auth::guard('candidate')->id())
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Đã đánh dấu tất cả thông báo là đã đọc');
    }
    public function cvWhite()
    {
        return view('candidate.cv_white');
    }
    public function cvBlack()
    {
        return view('candidate.cv_black');
    }
    public function cvLogistic()
    {
        return view('candidate.cv_logistic');
    }
    public function applications()
    {
        // Lấy candidate hiện tại
        $candidate = Auth::guard('candidate')->user();

        // Lấy danh sách ứng tuyển với eager loading
        $applications = Application::with(['jobPosting', 'jobPosting.employer'])
            ->where('candidate_id', $candidate->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10); // Phân trang, mỗi trang 10 items

        return view('candidate.applications', compact('applications'));
    }

    public function edit()
    {
        $candidate = Auth::guard('candidate')->user();
        $experiences = $candidate->experiences;
        $educations = $candidate->educations;
        $allSkills = Skill::all();
        $allSoftSkills = SoftSkill::all();
        $allLanguages = Language::all(); // thêm dòng này

        $cvs = $candidate->cvs;
        return view('candidate.profile', compact('candidate', 'experiences', 'educations', 'allSkills', 'allSoftSkills', 'allLanguages', 'cvs'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:candidates,email,' . Auth::guard('candidate')->id(),
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'avatar_candidate' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'gender' => 'required|string',
            'address' => 'required|string',
            'position' => 'required|string',
            'is_public' => 'nullable|in:0,1',
            'cv_public' => 'nullable|in:0,1',
            'linkedin' => 'required|string',
            'level' => 'required|string',
            'desired_level' => 'required|string',
            'desired_salary' => 'required|string',
            'education_level' => 'required|string',
            'years_of_experience' => 'required|integer',
            'working_form' => 'required|string',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'soft_skills' => 'nullable|array',
            'soft_skills.*' => 'exists:soft_skills,id',

        ]);

        // Retrieve the authenticated candidate
        $candidate = Auth::guard('candidate')->user();

        // Update the candidate's profile fields
        $candidate->name = $request->input('name');
        $candidate->email = $request->input('email');
        $candidate->phone = $request->input('phone');
        $candidate->dob = $request->input('dob');
        $candidate->gender = $request->input('gender');
        $candidate->address = $request->input('address');
        $candidate->position = $request->input('position');
        $candidate->is_public = $request->input('is_public', 0); // Default to 0 if not set
        $candidate->cv_public = $request->input('cv_public', 0); // Default to 0 if not set
        $candidate->linkedin = $request->input('linkedin');
        $candidate->level = $request->input('level');
        $candidate->desired_level = $request->input('desired_level');
        $candidate->desired_salary = $request->input('desired_salary');
        $candidate->education_level = $request->input('education_level');
        $candidate->years_of_experience = $request->input('years_of_experience');
        $candidate->working_form = $request->input('working_form');

        // Handle file uploads
        if ($request->hasFile('avatar_candidate')) {
            // Delete the old avatar from storage if exists
            if ($candidate->avatar_candidate && Storage::exists('public/avatars/' . $candidate->avatar_candidate)) {
                Storage::delete('public/avatars/' . $candidate->avatar_candidate);
            }

            // Store the new avatar and get the filename
            $avatarPath = $request->file('avatar_candidate')->store('avatars', 'public');
            $candidate->avatar_candidate = basename($avatarPath); // Save only the filename
        }
        $candidate->skills()->sync($request->input('skills', []));
        $candidate->softSkills()->sync($request->input('soft_skills', []));
        $languagesInput = $request->input('languages', []);
        $languageSyncData = [];

        foreach ($languagesInput as $langData) {
            if (!empty($langData['proficiency'])) {
                $languageSyncData[$langData['id']] = ['proficiency' => $langData['proficiency']];
            }
        }

        $candidate->languages()->sync($languageSyncData);
        $candidate->save();
        return redirect()->route('candidate.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
