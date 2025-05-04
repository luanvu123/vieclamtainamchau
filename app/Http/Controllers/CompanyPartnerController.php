<?php
namespace App\Http\Controllers;

use App\Models\CompanyPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyPartnerController extends Controller
{
    public function index()
    {
        $partners = CompanyPartner::all();
        return view('admin.company_partner.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.company_partner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('company_partners', 'public');
        }

        CompanyPartner::create([
            'name'   => $request->name,
            'image'  => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('company-partners.index')->with('success', 'Đối tác đã được thêm thành công.');
    }

    public function edit(CompanyPartner $companyPartner)
    {
        return view('admin.company_partner.edit', compact('companyPartner'));
    }

    public function update(Request $request, CompanyPartner $companyPartner)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = $companyPartner->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('company_partners', 'public');
        }

        $companyPartner->update([
            'name'   => $request->name,
            'image'  => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('company-partners.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(CompanyPartner $companyPartner)
    {
        if ($companyPartner->image) {
            Storage::disk('public')->delete($companyPartner->image);
        }

        $companyPartner->delete();
        return redirect()->route('company-partners.index')->with('success', 'Đã xóa đối tác.');
    }
}
