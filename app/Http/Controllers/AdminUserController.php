<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.show', compact('user'));
    }
}
