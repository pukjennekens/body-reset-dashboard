<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminRecipiesController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.recipies.index');
    }
}
