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

    public function anamnesis($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.anamnesis', compact('user'));
    }

    public function measurements($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.measurements', compact('user'));
    }

    public function credits($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.credits', compact('user'));
    }

    public function nutritionPlans($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.nutrition-plans', compact('user'));
    }

    public function creditOrders()
    {
        return view('dashboard.admin.settings.credit-orders');
    }

    public function appointments($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.appointments', compact('user'));
    }

    public function userOrders($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.orders', compact('user'));
    }
}
