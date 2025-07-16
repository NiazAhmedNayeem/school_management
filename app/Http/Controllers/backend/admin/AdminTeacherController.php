<?php

namespace App\Http\Controllers\backend\admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    public function allTeachers()
    {
        $teachers = Teacher::all();
        return view('backend.admin.user.teacher.index', compact('teachers'));
    }

    public function checkTeacherByNid(Request $request)
    {
        $teacher = \App\Models\Teacher::where('nid', $request->nid)->first();

        if ($teacher) {
            return response()->json([
                'exists' => true,
                'teacher' => $teacher,
            ]);
        } else {
            return response()->json([
                'exists' => false,
            ]);
        }
    }
    public function addTeacher()
    {
        return view('backend.admin.user.teacher.create');
    }
    
    public function storeTeacher(Request $request)
{
    $request->validate([
        'nid' => 'required|unique:teachers,nid',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required',
        'gender' => 'required|in:male,female',
        'dob' => 'required|date',
        'skills' => 'nullable|string',
        'department' => 'nullable|string',
        'about' => 'nullable|string',
        'address' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required',
    ]);

    DB::beginTransaction();

    try {
        // Create user first
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nid' => $request->nid,
            'phone' => $request->phone,
            'password' => bcrypt('12345678'),
            'role' => 'teacher',
        ]);

        // Handle image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('teachers', 'public');
        }

        // Create teacher without slug first
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'nid' => $request->nid,
            'slug' => '', // Temporary slug
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'skills' => $request->skills,
            'department' => $request->department,
            'about' => $request->about,
            'address' => $request->address,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        // Now create slug using id and name
        $slug = $teacher->id . '-' . Str::slug($request->name);
        $teacher->slug = $slug;
        //dd($teacher);
        $teacher->save();

        DB::commit();

        return redirect()->route('admin.all_teachers')->with('success', 'Teacher created successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong while creating teacher. Please try again.');
    }
}




}
