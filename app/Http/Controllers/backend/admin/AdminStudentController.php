<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index()
    {
        return view('backend.admin.student.index');
    }

    public function create()
    {
        // This method will return the view to create a new student
        return view('backend.admin.student.create');
    }

    public function store(Request $request)
    {
        // This method will handle the storing of a new student
        // Validation and storage logic goes here
    }

    public function edit($id)
    {
        // This method will return the view to edit an existing student
        return view('backend.admin.student.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // This method will handle the updating of an existing student
        // Validation and update logic goes here
    }

    public function destroy($id)
    {
        // This method will handle the deletion of a student
        // Deletion logic goes here
    }
}
