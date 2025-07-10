@extends('backend.layouts.master')
@section('title', 'Admin | Add New Student')
@section('main-content')

<div class="container-fluid px-4">
    <h1 class="text-2xl font-bold text-center mt-4">Add New Student</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store_student') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h3 class="text-lg font-semibold mb-3">🎓 Student Information</h3>

        <div class="row card-body border rounded mb-4">

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Name</label>
                <input type="text" name="student_name" value="{{ old('student_name') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Email</label>
                <input type="email" name="student_email" value="{{ old('student_email') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Phone</label>
                <input type="text" name="student_phone" value="{{ old('student_phone') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Class</label>
                <select name="class" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Select Class</option>
                    <option value="Class 1" {{ old('class') == 'Class 1' ? 'selected' : '' }}>Class 1</option>
                    <option value="Class 2" {{ old('class') == 'Class 2' ? 'selected' : '' }}>Class 2</option>
                    <option value="Class 3" {{ old('class') == 'Class 3' ? 'selected' : '' }}>Class 3</option>
                    <option value="Class 4" {{ old('class') == 'Class 4' ? 'selected' : '' }}>Class 4</option>
                    <option value="Class 5" {{ old('class') == 'Class 5' ? 'selected' : '' }}>Class 5</option>
                </select>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Section</label>
                <select name="section" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Section</option>
                    <option value="A" {{ old('section') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('section') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('section') == 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

             <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Gender</label>
                <select name="section" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('section') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('section') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('section') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Age</label>
                <input type="number" name="student_age" value="{{ old('student_age') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Pre School</label>
                <input type="text" name="student_pre_school" value="{{ old('student_pre_school') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Pre Class</label>
                <input type="text" name="student_pre_class" value="{{ old('student_pre_class') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Student Pre Section</label>
                <input type="text" name="student_pre_section" value="{{ old('student_pre_section') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>





        </div>

        <h3 class="text-lg font-semibold mb-3">👨‍👩‍👧‍👦 Parent Information</h3>

        <div class="row card-body border rounded">
            <div class="col-md-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold">Parent NID Number (auto check)</label>
                <input type="text" id="parent_nid" name="parent_nid" value="{{ old('parent_nid') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        

            <div id="parentInfo"  
                style="display: none;"
                class="bg-green-50 border border-green-300 p-4 rounded mb-4">
                <h4 class="font-medium mb-2">✅ Existing Parent Info:</h4>
                <p><strong>Name:</strong> <span id="p_name"></span></p>
                <p><strong>Email:</strong> <span id="p_email"></span></p>
                <p><strong>Phone:</strong> <span id="p_phone"></span></p>
                <p><strong>Address:</strong> <span id="p_address"></span></p>
            </div>

            <div id="newParentFields" style="display: none;">
                <p class="mb-2 text-red-600">❌ Parent not found. Please add new parent info below:</p>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <input type="text" name="parent_name" placeholder="Parent Name" value="{{ old('parent_name') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="col-md-4 mb-4">
                        <input type="email" name="parent_email" placeholder="Parent Email" value="{{ old('parent_email') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="col-md-4 mb-4">
                        <input type="text" name="parent_phone" placeholder="Phone" value="{{ old('parent_phone') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="col-md-4 mb-4">
                        <input type="text" name="parent_occupation" placeholder="Occupation" value="{{ old('parent_occupation') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="col-md-4 mb-4">
                        <input type="text" name="parent_address" placeholder="Address" value="{{ old('parent_address') }}" class="form-control w-100 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
            </div>

        </div>


        <div class="col-md-12 mt-2 text-center">
            <button type="submit" class="btn btn-primary px-4 py-2 font-bold rounded focus:outline-none focus:shadow-outline">
                Create Student
            </button>
        </div>

        


    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let typingTimer;                
    let doneTypingInterval = 800; // milliseconds

    $('#parent_nid').on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    $('#parent_nid').on('keydown', function () {
        clearTimeout(typingTimer);
    });

    function doneTyping() {
        let nid = $('#parent_nid').val();

        if (!nid) {
            $('#parentInfo').hide();
            $('#newParentFields').show();
            return;
        }

        $.ajax({
            //url: '{{ route("parents.checkNid") }}',
            type: 'GET',
            data: { nid: nid },
            success: function(response) {
                if (response.status === 'found') {
                    $('#parentInfo').show();
                    $('#newParentFields').hide();

                    $('#p_name').text(response.parent.name);
                    $('#p_email').text(response.parent.email);
                    $('#p_phone').text(response.parent.phone);
                    $('#p_address').text(response.parent.address);
                } else {
                    $('#parentInfo').hide();
                    $('#newParentFields').show();
                }
            }
        });
    }
</script>
@endsection
