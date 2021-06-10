<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Moderator\Auth\LoginRequest;
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
        if (auth()->guard('moderator')->check()) {
            return redirect()->route('moderator.dashboard');
        }

        return view('moderator.pages.auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        auth()->attempt(['username' => $request->username, 'password' => $request->password]);
        if (auth()->user()) {
            auth()->guard('moderator')->loginUsingId(auth()->user()->moderator->id);
            auth()->logout();

            if (auth()->guard('moderator')->check()) {
                return redirect()->route('moderator.dashboard');
            }
        }

        return back()->withErrors("These credentials do not match our records.");
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->guard('moderator')->logout();

        return redirect()->route('moderator.login')->with('success', "You have successfully logged out.");
    }
}
