<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Xác thực thông tin đăng nhập
        $request->authenticate();

        // Lấy người dùng đã xác thực
        $user = $request->user();

        // Tạo token cho người dùng đã xác thực
        $token = $user->createToken('authToken')->plainTextToken;

        // Gửi token về cho người dùng (sử dụng session flash)
        $request->session()->put('token', $token);


        // Regenerate session để đảm bảo tính bảo mật
        $request->session()->regenerate();

        // Redirect về trang chủ hoặc trang được yêu cầu trước đó
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
