@extends('backend.layouts.master')
@section('title', 'Admin | Edit Class')
@section('main-content')


    <h1 class="text-2xl font-bold text-center mt-4">Edit Class</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="classForm" method="POST" action="{{ route('admin.update_class', $class->id) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h3 class="text-lg font-semibold mb-3">Edit Class Information</h3>
        <div class="row card-body border rounded mb-4">

            <div class="col-md-4 mt-4">
                <label>Class Name</label>
                <input type="text" id="class_name" name="class_name" value="{{ $class->class_name }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label>Class Slug</label>
                <input type="text" id="slug" name="slug" value="{{ $class->slug }}" class="form-control" required>
            </div>

            <div class="col-md-4 mt-4">
                <label class="block text-gray-700 text-sm font-bold">Status</label>
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" {{ $class->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $class->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

        </div>

        <div class="col-md-12 mt-4 text-center">
            <button type="submit" id="checkBtn" class="btn btn-primary px-4 py-2 font-bold rounded focus:outline-none focus:shadow-outline">
                Create Class
            </button>
        </div>

        <p id="message" class="mt-2 font-bold"></p>
    </form>


@endsection 