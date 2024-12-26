<?php
namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:bank-list|bank-create|bank-edit|bank-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:bank-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:bank-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bank-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $banks = Bank::where('user_id', Auth::id())->get();
        return view('admin.banks.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.banks.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'area' => 'required|in:Khu vực miền bắc,Khu vực miền nam',
        'name' => 'required|string|max:255',
        'branch' => 'required|string|max:255',
        'account_number' => 'required|string|max:255',
        'content' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'logo_bank' => 'nullable|image|max:2048',
        'status' => 'nullable|in:0,1',
    ]);

    $bank = new Bank($request->all());
    $bank->user_id = Auth::id();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('banks', 'public');
        $bank->image = $imagePath;
    }

    if ($request->hasFile('logo_bank')) {
        $logo = $request->file('logo_bank');
        $logoPath = $logo->store('banks', 'public');
        $bank->logo_bank = $logoPath;
    }

    $bank->save();

    return redirect()->route('banks.index')->with('success', 'Ngân hàng đã được thêm.');
}

    public function edit(Bank $bank)
    {
        if ($bank->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

        return view('admin.banks.edit', compact('bank'));
    }

   public function update(Request $request, Bank $bank)
{
    if ($bank->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'area' => 'required|in:Khu vực miền bắc,Khu vực miền nam',
        'name' => 'required|string|max:255',
        'branch' => 'required|string|max:255',
        'account_number' => 'required|string|max:255',
        'content' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'logo_bank' => 'nullable|image|max:2048',
        'status' => 'nullable|in:0,1',
    ]);

    $bank->fill($request->all());

    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có
        if ($bank->image) {
            Storage::disk('public')->delete($bank->image);
        }

        $image = $request->file('image');
        $imagePath = $image->store('banks', 'public');
        $bank->image = $imagePath;
    }

    if ($request->hasFile('logo_bank')) {
        // Xóa logo cũ nếu có
        if ($bank->logo_bank) {
            Storage::disk('public')->delete($bank->logo_bank);
        }

        $logo = $request->file('logo_bank');
        $logoPath = $logo->store('banks', 'public');
        $bank->logo_bank = $logoPath;
    }

    $bank->save();

    return redirect()->route('banks.index')->with('success', 'Thông tin ngân hàng đã được cập nhật.');
}

    public function destroy(Bank $bank)
    {
       if ($bank->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }
        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Ngân hàng đã được xóa.');
    }
}
