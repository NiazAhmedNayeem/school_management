@extends('backend.layouts.master')
@section('title', 'Admin | Edit Teacher Info')
@section('main-content')


    <h1 class="text-2xl font-bold text-center mt-4">Edit Teacher Info</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="classForm" method="POST" action="{{ route('admin.update_class', $teacher->id) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h3 class="text-lg font-semibold mb-3">Edit Teacher Information</h3>
        <div class="row card-body border rounded mb-4">

            <div class="col-md-4 mt-4">
                <label>Teacher Name</label>
                <input type="text" id="name" name="name" value="{{ $teacher->name }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>Teacher Slug</label>
                <input type="text" id="slug" name="slug" value="{{ $teacher->slug }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>Email</label>
                <input type="email" id="email" name="email" value="{{ $teacher->email }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>Phone</label>
                <input type="number" id="phone" name="phone" value="{{ $teacher->phone }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label class="block text-gray-700 text-sm font-bold">Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="male" {{ $teacher->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $teacher->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="col-md-4 mt-4">
                <label>NID Number</label>
                <input type="number" id="nid" name="nid" value="{{ $teacher->nid }}" class="form-control" required>
            </div>
    
            <div class="col-md-4 mt-4">
                <label>Date of Birth</label>
                <input type="date" id="dob" name="dob" value="{{ $teacher->dob }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>Skills</label>
                <input type="text" id="skills" name="skills" value="{{ $teacher->skills }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>Department</label>
                <input type="text" id="department" name="department" value="{{ $teacher->department }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>About</label>
                <textarea type="text" id="about" name="about" class="form-control">{{ $teacher->about }}</textarea>
            </div>

            <div class="col-md-4 mt-4">
                <label>Address</label>
                <input type="text" id="address" name="address" value="{{ $teacher->address }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label class="block text-gray-700 text-sm font-bold">Status</label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ $teacher->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $teacher->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <div class="col-md-12 mt-4 text-center">
            <button type="submit" id="checkBtn" class="btn btn-primary px-4 py-2 font-bold rounded focus:outline-none focus:shadow-outline">
                Update Teacher Info
            </button>
        </div>

        <p id="message" class="mt-2 font-bold"></p>
    </form>


@endsection 