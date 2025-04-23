<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = $request->input('role');
        $sort = $request->input('sort');
        $keyword = $request->input('keyword');

        $query = User::query();

        if ($role) {
            $query->where('role', $role);
        }

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($sort == 'asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'desc') {
            $query->orderBy('name', 'desc');
        }

        $userList = $query->paginate(10)->appends($request->query());

        $newUsers = User::where('created_at', '>=', now()->subWeek())->count();
        $totalUsers = User::count();

        return view('admin.user.list', [
            'userList' => $userList,
            'totalUsers' => $totalUsers,
            'newUsers' => $newUsers,
            'selectedRole' => $role,
        ]);
    }




    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:customer,admin', // Chỉ chấp nhận 'customer' hoặc 'admin'
        ], [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu ít nhất phải có 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.string' => 'Địa chỉ không hợp lệ.',
            'role.required' => 'Vui lòng chọn vai trò.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mã hóa mật khẩu
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role; // Lưu role dưới dạng string 'customer' hoặc 'admin'

        $user->save();

        return redirect('/admin/user')->with('success', 'Thêm người dùng thành công!');
    }


    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.update', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.update', ['user' => $user]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Password is optional on update
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'role' => 'required|string|in:customer,admin',
        ], [
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.min' => 'Mật khẩu ít nhất phải có 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.string' => 'Địa chỉ không hợp lệ.',
            'role.required' => 'Vui lòng chọn vai trò.',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Encrypt new password if provided
        }

        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;

        $user->save();

        return redirect("/admin/user/$id")->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete(); // Xóa người dùng

        return redirect()->route('admin.user.index')->with('success', 'Xóa người dùng thành công');
    }
}
