<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @return Factory|RedirectResponse|View
     */
    public function index()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.pages.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        auth()->attempt(['username' => $request->username, 'password' => $request->password]);
        if (auth()->user()) {
            auth()->guard('admin')->loginUsingId(auth()->user()->admin->id);
            auth()->logout();

            if (auth()->guard('admin')->check()) {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors("These credentials do not match our records.");
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login')->with('success', "You have successfully logged out.");
    }
}



