<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminClassController extends Controller
{
    public function allClasses()
    {
        $classes = SchoolClass::all();
        return view('backend.admin.class.index', compact('classes'));
    }

    public function addClass()
    {
        return view('backend.admin.class.create');
    }

    public function storeClass(Request $request)
    {
        $name = $request->input('class_name');
        $request->validate([
        'class_name' => 'required|unique:school_classes,class_name',
    ], 
            [
                'class_name.unique' => '❌ This ' . $name . ' name already exists in database. Please choose a different one.',
                'class_name.required' => '⚠️ Class name is required.',
            ]);

        $class = new SchoolClass();
        $class->class_name = $request->input('class_name');
        $class->slug = Str::slug($request->class_name);
        $class->save();
        return redirect()->route('admin.all_classes')->with('success', 'Class created successfully!');
    }

    // public function checkClassName(Request $request)
    // {
    //     $className = $request->input('class_name');
    //     $exists = SchoolClass::where('class_name', $className)->exists();
    //     return response()->json(['status' => $exists]);
    // }

    public function editClass($id)
    {
        $class = SchoolClass::findOrFail($id);  
        return view('backend.admin.class.edit', compact('class'));
    }

    public function updateClass(Request $request, $id)
    {
        $class = SchoolClass::findOrFail($id);
        $name = $request->input('class_name');
        $request->validate([
            'class_name' => 'required|unique:school_classes,class_name,' . $class->id,
        ], 
            [
                'class_name.unique' => '❌ This ' . $name . ' name already exists in database. Please choose a different one.',
                'class_name.required' => '⚠️ Class name is required.',
            ]);

        $class->class_name = $request->input('class_name');
        $class->slug = Str::slug($request->slug);
        $class->status = $request->input('status'); // Default to 'active' if not provided
        //dd($class);
        $class->save();
        return redirect()->route('admin.all_classes')->with('success', 'Class updated successfully!');
    }

    public function deleteClass($id)
    {
        $class = SchoolClass::findOrFail($id);
        $class->delete();
        return redirect()->route('admin.all_classes')->with('success', 'Class deleted successfully!');
    }

    public function updateClassStatus(Request $request)
    {
        $class = SchoolClass::find($request->id);

        if ($class) {
            $class->status = $request->status;
            $class->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Class not found.']);
    }

}
