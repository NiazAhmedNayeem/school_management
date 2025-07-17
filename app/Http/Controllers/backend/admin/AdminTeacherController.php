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

            //dd($user);

            // Handle image
            if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = 'backend/upload/teachers'; 
            
            $image->move(public_path($uploadPath), $imageName);
            
            $imagePath = $uploadPath . '/' . $imageName; 
                $imagePath = null;
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

    public function editTeacher($slug)
    {
        $teacher = Teacher::where('slug', $slug)->firstOrFail();
        $user = User::where('id', $teacher->user_id)->first();
        //dd($teacher);
        return view('backend.admin.user.teacher.edit', compact('teacher', 'user'));
    }

    public function checkNidForUpdate(Request $request)
    {
        $nid = $request->nid;
        $slug = $request->slug;

        $teacher = Teacher::where('nid', $nid)
            ->where('slug', '!=', $slug)
            ->first();

        return response()->json(['exists' => $teacher ? true : false]);
    }

    public function updateTeacher(Request $request, $slug)
    {
        $teacher = Teacher::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nid' => 'required|unique:teachers,nid,' . $teacher->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'phone' => 'required',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'skills' => 'nullable|string',
            'department' => 'nullable|string',
            'about' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update teacher info
        $teacher->name = $request->name;
        $teacher->slug = $teacher->id . '-' . Str::slug($request->name);
        $teacher->nid = $request->nid;
        $teacher->phone = $request->phone;
        $teacher->gender = $request->gender;
        $teacher->dob = $request->dob;
        $teacher->skills = $request->skills;
        $teacher->department = $request->department;
        $teacher->about = $request->about;
        $teacher->address = $request->address;
        $teacher->status = $request->status;
   
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('backend/upload/teachers'), $imageName);
        //     $imagePath = 'public/backend/upload/teachers/' . $imageName;
        // } else {
        //     $imagePath = null;
        // }
        
        if ($request->hasFile('image')) {
           
            if ($teacher->image && file_exists(public_path($teacher->image)) && !str_contains($teacher->image, 'default.jpg')) {
                @unlink(public_path($teacher->image));
            }

            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = 'backend/upload/teachers';
            $image->move(public_path($uploadPath), $imageName);

            
            $teacher->image = $uploadPath . '/' . $imageName;
        }

        //dd($teacher);
        $teacher->save();

        // Update related user info
        if ($teacher->user) {
            $teacher->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'nid' => $request->nid,
            ]);
        }

        return redirect()->back()->with('success', 'Teacher info updated successfully!');
    }


}
