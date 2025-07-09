<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    //Student Dashboard
    public function index(){
        return view('backend.student.dashboard.index');
    }
}
