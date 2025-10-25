<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $data = City::all();
        return view('admin.dashboard',compact('data'));
    }
}
