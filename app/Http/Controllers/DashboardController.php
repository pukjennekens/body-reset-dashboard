<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardRedirector()
    {
        if(auth()->user()->hasRole('admin')) return redirect()->route('dashboard.admin.home');
        if(auth()->user()->hasRole('manager')) return redirect()->route('dashboard.admin.home');
        if(auth()->user()->hasRole('trainer')) return redirect()->route('dashboard.admin.home');

        return redirect()->route('dashboard.user.home');
    }

    public function userHome()
    {
        return view('dashboard.user.index');
    }

    public function userNutritionPlans()
    {
        return view('dashboard.user.nutrition-plans');
    }

    public function userNutritionPlan($id)
    {
        $nutritionPlan = auth()->user()->nutritionPlans()->findOrFail($id);
        return view('dashboard.user.nutrition-plan', compact('nutritionPlan'));
    }

    public function userAppointments()
    {
        return view('dashboard.user.appointments');
    }

    public function adminHome()
    {
        return view('dashboard.admin.index');
    }
}
