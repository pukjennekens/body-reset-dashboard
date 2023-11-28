<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function credits()
    {
        return view('dashboard.admin.settings.credits');
    }
}
