@extends('backend.layouts.master')
@section('title', 'Admin | Edit Section')
@section('main-content')

<div class="col-md-12 mb-4">
    <h1 class="text-2xl font-bold text-center mt-4">Edit Section</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="sectionForm" method="POST" action="{{ route('admin.update_section', $section->id) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded p-4">
        @csrf

        <h3 class="text-lg font-semibold mb-3">Edit Section Information</h3>
        <div class="row card-body border rounded mb-4">

            <div class="col-md-3 mt-3">
                <label>Section Name</label>
                <input type="text" id="section_name" name="section_name" value="{{ $section->section_name }}" class="form-control" required>
            </div>

            <div class="col-md-3 mt-3">
                <label>Class</label>
                <select name="class_id" class="form-control" required>
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ $section->class_id == $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mt-3">
                <label>Slug</label>
                <input type="text" id="slug" name="slug" value="{{ $section->slug }}" class="form-control" required>
            </div>

            <div class="col-md-3 mt-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ $section->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $section->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <div class="col-md-12 mt-4 text-center">
            <button type="submit" class="btn btn-primary px-4 py-2 font-bold rounded focus:outline-none focus:shadow-outline">
                Update Section
            </button>
        </div>

    </form>
</div>

@endsection
