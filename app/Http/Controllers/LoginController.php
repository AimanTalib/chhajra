<?php

namespace App\Http\Controllers;

use App\Models\AdminLogin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        $pagename = "Admin Login";
        return view(
            'login',
            [
                'pagename' => $pagename
            ]
        );
    }
    public function admin_logged(Request $request)
    {
        $usernameOrEmail = $request->usernameOrEmail;
        $count = AdminLogin::where(function ($q) use ($usernameOrEmail) {
            $q->where('username', $usernameOrEmail)
                ->orWhere('email', $usernameOrEmail);
        })->where('password', $request->password)->count();
        if ($count < 1) {
            return Redirect()->back()->with('wrong-password', 'Admin Details is successfully Update!');
        } else {
            $usernameOrEmail = $request->usernameOrEmail;
            $admin = AdminLogin::where(function ($q) use ($usernameOrEmail) {
                $q->where('username', $usernameOrEmail)
                    ->orWhere('email', $usernameOrEmail);
            })->where('password', $request->password)->first();
            $request->session()->put('admin_id', $admin->id);
            $request->session()->put('admin_username', $admin->username);
            $request->session()->put('admin_password', $admin->password);
            $request->session()->put('admin_email', $admin->email);
            return Redirect()->route('dashboard');
        }
    }
    public function admin_logout(Request $request)
    {
        // ddd($request);
        $request->session()->forget(['admin_id', 'admin_username', 'admin_password', 'admin_email']);
        $request->session()->flush();

        return Redirect()->route('login');
    }
    public function dashboard(Request $request)
    {
        $pagename = 'dashboard';
        return view('dashboard', [
            'pagename' => $pagename,
        ]);
    }
}
