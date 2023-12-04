<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function credits()
    {
        return view('dashboard.admin.settings.credits');
    }

    public function branches()
    {
        return view('dashboard.admin.settings.branches');
    }

    public function branch($id)
    {
        $branch = Branch::findOrFail($id);
        return view('dashboard.admin.settings.branches.branch', compact('branch'));
    }

    public function services()
    {
        return view('dashboard.admin.settings.services');
    }
}
