<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return view('dashboard.admin');
        } elseif ($role == 'manager') {
            return view('dashboard.manager');
        } else {
            return view('dashboard.staff');
        }
    }
}
