<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
// use DB;
use Illuminate\Support\Facades\DB;

// use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-choose', ['only' => ['user_choose']]);
        $this->middleware('permission:user-list|role-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['user' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['user' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['user' => ['destroy']]);
    }
    public function index()
    {

        $users = User::all(); // Lấy danh sách tất cả người dùng

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'favorite_color' => 'nullable|string',
            'status' => 'nullable',
            'date' => 'nullable',
            'phone' => 'nullable|string',
            'language' => 'nullable|string',
            'google' => 'nullable|string',
            'skype' => 'nullable|string',
            'slack' => 'nullable|string',
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'paypal' => 'nullable|string',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Process and save the avatar file
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatar', 'public');
            $input['avatar'] = $avatarPath;
        }

        // Create the user
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::findOrFail($id);

        // Kiểm tra vai trò của người dùng hiện tại
        $userRoleIds = Auth::user()->roles->pluck('id')->toArray();

        if (in_array(1, $userRoleIds)) {
            // Người dùng có vai trò role_id = 1 có thể xem thông tin của bất kỳ ai
            return view('admin.users.show', compact('user'));
        } elseif ($user->id !== Auth::id()) {
            // Nếu không phải role_id = 1, chỉ cho phép xem thông tin của chính mình
            abort(403, 'Unauthorized action.');
        }
        return view('admin.users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::findOrFail($id);

        // Kiểm tra vai trò của người dùng hiện tại
        $currentUserRoleIds = Auth::user()->roles->pluck('id')->toArray();

        if (!in_array(1, $currentUserRoleIds) && $user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id): RedirectResponse
    {
        // Tìm người dùng dựa trên ID
        $user = User::findOrFail($id);

        // Lấy vai trò của người dùng hiện tại
        $userRoleIds = Auth::user()->roles->pluck('id')->toArray();

        // Kiểm tra quyền truy cập
        if (in_array(1, $userRoleIds) || $user->id === Auth::id()) {
            // Xác thực dữ liệu từ yêu cầu
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|same:confirm-password',
                'roles' => 'nullable', 
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'gender' => 'nullable|string',
                'address' => 'nullable|string',
                'favorite_color' => 'nullable|string',
                'status' => 'nullable',
                'date' => 'nullable',
                'phone' => 'nullable|string',
                'language' => 'nullable|string',
                'google' => 'nullable|string',
                'skype' => 'nullable|string',
                'slack' => 'nullable|string',
                'instagram' => 'nullable|string',
                'facebook' => 'nullable|string',
                'paypal' => 'nullable|string',
                'status' => 'nullable|in:active,inactive',
            ]);

            // Lấy tất cả dữ liệu từ yêu cầu
            $input = $request->all();

            // Xử lý mật khẩu nếu có
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, ['password']);
            }

            // Xử lý ảnh đại diện nếu có
            if ($request->hasFile('avatar')) {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $avatar = $request->file('avatar');
                $avatarPath = $avatar->store('avatar', 'public');
                $input['avatar'] = $avatarPath;
            }

            // Cập nhật thông tin người dùng
            $user->update($input);


            if (in_array(1, $userRoleIds)) {
                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->input('roles'));
            } else {
                abort(403, 'Unauthorized action.');
            }

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        }

        // Nếu không có quyền truy cập, trả về lỗi 403
        abort(403, 'Unauthorized action.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);
        $avatar = $user->avatar;

        $user->delete();

        if (!empty($avatar)) {
            Storage::disk('public')->delete($avatar);
        }

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
    public function user_choose(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        $user->status = $data['trangthai_val'];
        $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $user->save();
    }

    public function updatePassword(Request $request, $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // confirmed để kiểm tra trường password_confirmation
        ]);

        // Tìm người dùng theo ID
        $user = User::findOrFail($id);

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Điều hướng người dùng sau khi cập nhật thành công
        return redirect()->route('users.show', $user->id)->with('success', 'Password updated successfully.');
    }
}
