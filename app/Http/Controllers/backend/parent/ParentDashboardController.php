<?php

namespace App\Http\Controllers\backend\parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentDashboardController extends Controller
{
    public function index(){
        return view('backend.parent.dashboard.index');
    }
}
