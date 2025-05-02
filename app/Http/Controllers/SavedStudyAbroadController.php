<?php

namespace App\Http\Controllers;

use App\Models\CandidateStudyAbroad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedStudyAbroad;
use App\Models\StudyAbroad;

class SavedStudyAbroadController extends Controller
{
    public function toggleSave($studyAbroadId)
    {
        $candidate = Auth::guard('candidate')->user();

        if (!$candidate) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để lưu chương trình du học.'], 401);
        }

        $savedStudyAbroad = SavedStudyAbroad::where('candidate_id', $candidate->id)
            ->where('study_abroad_id', $studyAbroadId)
            ->first();

        if ($savedStudyAbroad) {
            $savedStudyAbroad->delete();
            return response()->json(['success' => true, 'saved' => false]);
        } else {
            SavedStudyAbroad::create([
                'candidate_id' => $candidate->id,
                'study_abroad_id' => $studyAbroadId
            ]);
            return response()->json(['success' => true, 'saved' => true]);
        }
    }


    public function checkSaved($studyAbroadId)
    {
        $candidateId = Auth::guard('candidate')->id();

        $isSaved = SavedStudyAbroad::where('candidate_id', $candidateId)
            ->where('study_abroad_id', $studyAbroadId)
            ->exists();

        return response()->json(['saved' => $isSaved]);
    }

    public function savedStudyAbroad()
    {
        $candidateId = Auth::guard('candidate')->id();

        $savedStudyAbroad = StudyAbroad::whereHas('savedByCandidates', function ($query) use ($candidateId) {
            $query->where('candidate_id', $candidateId);
        })->paginate(4); 

        return view('candidate.saved_study_abroad', compact('savedStudyAbroad'));
    }
    public function registerConsultation(Request $request, $studyAbroadId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $candidate = Auth::guard('candidate')->user();

        // Kiểm tra đã tồn tại hay chưa
        $existing = CandidateStudyAbroad::where('candidate_id', $candidate->id)
            ->where('study_abroad_id', $studyAbroadId)
            ->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký tư vấn cho chương trình này rồi!');
        }

        CandidateStudyAbroad::create([
            'candidate_id' => $candidate->id,
            'study_abroad_id' => $studyAbroadId,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Bạn đã đăng ký tư vấn thành công!');
    }

}
