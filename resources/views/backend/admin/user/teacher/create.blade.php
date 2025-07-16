@extends('backend.layouts.master')
@section('title', 'Admin | Add New Teacher')
@section('main-content')

<h1 class="text-2xl font-bold text-center mt-4">Add New Teacher</h1>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="teacherForm" method="POST" action="{{ route('admin.store_teacher') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    @csrf

    <h3 class="text-lg font-semibold mb-3">📚 Teacher Information</h3>
    <div class="row card-body border rounded mb-4">

        <div class="col-md-4 mt-4">
            <label>Teacher's NID Number</label>
            <input type="number" id="nid" name="nid" value="{{ old('nid') }}" class="form-control" required>
            <small id="nidMessage" class="text-danger"></small>
        </div>

        <div id="teacherFields">

            <div class="row card-body col-md-12">



                <div class="col-md-4 mt-4">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                {{-- <div class="col-md-4 mt-4">
                    <label>Teacher Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" required>
                </div> --}}

                <div class="col-md-4 mt-4">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <div class="col-md-4 mt-4">
                    <label>Phone</label>
                    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" required>
                </div>

                <div class="col-md-4 mt-4">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="col-md-4 mt-4">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob') }}" class="form-control" required>
                </div>

                <div class="col-md-4 mt-4">
                    <label>Skills</label>
                    <input type="text" name="skills" value="{{ old('skills') }}" class="form-control">
                </div>

                <div class="col-md-4 mt-4">
                    <label>Department</label>
                    <input type="text" name="department" value="{{ old('department') }}" class="form-control">
                </div>

                <div class="col-md-4 mt-4">
                    <label>About</label>
                    <textarea name="about" class="form-control">{{ old('about') }}</textarea>
                </div>

                <div class="col-md-4 mt-4">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                </div>

                <div class="col-md-4 mt-4">
                    <label>Profile Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-4 mt-4">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

            </div>
        </div>

    </div>

    <div class="col-md-12 mt-4 text-center">
        <button type="submit" id="submitBtn" class="btn btn-primary px-4 py-2 font-bold rounded focus:outline-none focus:shadow-outline">
            Create Teacher
        </button>
    </div>
</form>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#teacherFields').show();

        $('#nid').on('input', function() {
            let nid = $(this).val();
            if (nid.length > 0) {
                $.ajax({
                    url: '{{ route("admin.check_teacher_nid") }}',
                    type: 'GET',
                    data: { nid: nid },
                    success: function(response) {
                        if (response.exists) {
                            $('#nidMessage').text('❌ This NID already exists. Cannot create duplicate teacher.');
                            $('#teacherFields').hide();
                            $('#submitBtn').prop('disabled', true);
                        } else {
                            $('#nidMessage').text('');
                            $('#teacherFields').show();
                            $('#submitBtn').prop('disabled', false);
                        }
                    }
                });
            } else {
                $('#nidMessage').text('');
                $('#teacherFields').show();
                $('#submitBtn').prop('disabled', false);
            }
        });
    });
</script>
@endsection
