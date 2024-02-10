<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if(Auth::id())
        {
            $usertype =Auth()->user()->usertype;
            
            if($usertype=='user')
            {
                return view('user_dashboard');
            }
            else if($usertype=='admin')
            {
                return view('admin_panel.admin_dashboard');
            }
        }
        else
        {
            // return redirect()->back();

            return Redirect()->route('login');
        }
    }
    public function adminpage()
    {
        return view('admin_panel.admin_page');
    }
}
