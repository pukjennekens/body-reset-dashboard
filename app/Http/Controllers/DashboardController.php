<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardRedirector()
    {
        return redirect()->route('dashboard.user.home');
    }

    public function userHome()
    {
        return view('dashboard.user.home');
    }
}
