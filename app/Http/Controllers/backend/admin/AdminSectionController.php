<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\SchoolSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminSectionController extends Controller
{
    public function allSections()
    {
        $sections = \App\Models\SchoolSection::with('class')->get();
        return view('backend.admin.section.index', compact('sections'));
    }
    public function addSection()
    {
        $classes = \App\Models\SchoolClass::all();
        return view('backend.admin.section.create', compact('classes'));
    }
    public function storeSection(Request $request)
    {
        // $request->validate([
        //     'section_name' => 'required|unique:school_sections,section_name',
        //     'class_id' => 'required|exists:school_classes,id',
        // ], [
        //     'section_name.required' => '⚠️ Section name is required.',
        //     'section_name.unique' => '❌ This section name already exists. Please choose a different one.',
        //     'class_id.required' => '⚠️ Class is required.',
        //     'class_id.exists' => '⚠️ The selected class does not exist.',
        // ]);
        $request->validate([
            'section_name' => [
                'required',
                Rule::unique('school_sections', 'section_name')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })
            ],
            'class_id' => 'required|exists:school_classes,id',
        ], [
            'section_name.required' => '⚠️ Section name is required.',
            'section_name.unique' => '❌ This section name already exists for this class. Please choose a different one.',
            'class_id.required' => '⚠️ Class is required.',
            'class_id.exists' => '⚠️ The selected class does not exist.',
        ]);

        $class = SchoolClass::findOrFail($request->class_id);
        $classSlug = \Illuminate\Support\Str::slug($class->class_name);
        $sectionSlug = \Illuminate\Support\Str::slug($request->section_name);
        $slug = $classSlug . '-' . $sectionSlug;
        
        $section = new \App\Models\SchoolSection();
        $section->section_name = $request->input('section_name');
        $section->slug = $slug;
        $section->class_id = $request->input('class_id');
        //dd($section);
        $section->save();
        return redirect()->route('admin.all_sections')->with('success', 'Section created successfully!');
    }
    public function editSection($slug)
    {
        $section = \App\Models\SchoolSection::where('slug', $slug)->firstOrFail();
        $classes = \App\Models\SchoolClass::all();
        return view('backend.admin.section.edit', compact('section', 'classes'));
    }
        // $section = \App\Models\SchoolSection::findOrFail($id);
        // $classes = \App\Models\SchoolClass::all();
        // return view('backend.admin.section.edit', compact('section', 'classes'));


    // public function updateSection(Request $request, $id)
    // {
    //     $section = \App\Models\SchoolSection::findOrFail($id);
    //     $request->validate([
    //         'section_name' => [
    //             'required',
    //             Rule::unique('school_sections', 'section_name')->ignore($section->id)->where(function ($query) use ($request) {
    //                 return $query->where('class_id', $request->class_id);
    //             })
    //         ],
    //         'class_id' => 'required|exists:school_classes,id',
    //     ], [
    //         'section_name.required' => '⚠️ Section name is required.',
    //         'section_name.unique' => '❌ This section name already exists for this class. Please choose a different one.',
    //         'class_id.required' => '⚠️ Class is required.',
    //         'class_id.exists' => '⚠️ The selected class does not exist.',
    //     ]);

    //     $class = SchoolClass::findOrFail($request->class_id);
    //     $classSlug = \Illuminate\Support\Str::slug($class->class_name);
    //     $sectionSlug = \Illuminate\Support\Str::slug($request->section_name);
    //     $slug = $classSlug . '-' . $sectionSlug;

    //     $section->section_name = $request->input('section_name');
    //     $section->slug = $slug;
    //     $section->class_id = $request->input('class_id');
    //     $section->save();
        
    //     return redirect()->route('admin.all_sections')->with('success', 'Section updated successfully!');
    // }

    public function updateSection(Request $request, $id)
    {
        $section = \App\Models\SchoolSection::findOrFail($id);

        // Validation
        $request->validate([
            'section_name' => [
                'required',
                Rule::unique('school_sections', 'section_name')
                    ->ignore($section->id)
                    ->where(function ($query) use ($request) {
                        return $query->where('class_id', $request->class_id);
                    }),
            ],
            'class_id' => 'required|exists:school_classes,id',
            'slug' => [
                'nullable',
                Rule::unique('school_sections', 'slug')->ignore($section->id)
            ]
        ], [
            'section_name.required' => '⚠️ Section name is required.',
            'section_name.unique' => '❌ This section name already exists for this class. Please choose a different one.',
            'class_id.required' => '⚠️ Class is required.',
            'class_id.exists' => '⚠️ The selected class does not exist.',
            'slug.unique' => '❌ This slug already exists. Please choose a different one.',
        ]);

        $class = \App\Models\SchoolClass::findOrFail($request->class_id);
        $classSlug = Str::slug($class->class_name);
        $sectionSlug = Str::slug($request->section_name);

        // jodi user slug field e kisu likhe, taole seta nibe
        if (!empty($request->slug)) {
            $finalSlug = $request->slug;
        } else {
            // na likhle default vabe class-slug-section-slug korbe
            $finalSlug = $classSlug . '-' . $sectionSlug;
        }

        $section->section_name = $request->input('section_name');
        $section->class_id = $request->input('class_id');
        $section->slug = $finalSlug;
        $section->status = $request->input('status', $section->status); // Status update optional

        $section->save();

        return redirect()->route('admin.all_sections')->with('success', 'Section updated successfully!');
    }

    public function deleteSection($slug)
    {
        $section = \App\Models\SchoolSection::where('slug', $slug)->firstOrFail();
        $section->delete();
        return redirect()->route('admin.all_sections')->with('success', 'Section deleted successfully!');   
    }

    public function updateSectionStatus(Request $request)
    {
        $section = SchoolSection::find($request->id);

        if ($section) {
            $section->status = $request->status;
            $section->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Section not found.']);
    }
}