<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function list(Request $request)
    {
        try {
            $keyword = $request->input('keyword', ''); // Lấy từ khóa tìm kiếm từ request

            // Tìm kiếm người dùng với điều kiện tên chứa từ khóa
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate(10);

            return view('admin.user.list', compact('users'));
        } catch (\Exception $e) {
            // Xử lý ngoại lệ, ví dụ: log lỗi, hiển thị thông báo lỗi, v.v.
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }

    public function add(Request $request)
    {
        return view('admin.user.add');
    }
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            return redirect('admin/user/list')->with('status', 'Đã thêm thành viên thành công');
        } catch (\Exception $e) {
            // Xử lý ngoại lệ, ví dụ: log lỗi, hiển thị thông báo lỗi, v.v.
            return redirect()->back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
    }
    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
            # code...
            return redirect('admin/user/list')->with('status', 'Đã xóa thành viên thành công');
        } else {
            return redirect('admin/user/list')->with('status', 'Bạn không thể tự xóa chính mình ');
        }
    }
}
