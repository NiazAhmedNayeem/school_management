@extends('backend.layouts.master')
@section('title', 'Admin | Add New Class')
@section('main-content')

<div class="container-fluid px-4">
    <h1 class="text-2xl font-bold text-center mt-4">Add New Class</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="classForm" method="POST" action="{{ route('admin.store_class') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h3 class="text-lg font-semibold mb-3">📚 Class Information</h3>
        <div class="row card-body border rounded mb-4">

            <div class="col-md-4 mt-4">
                <label>Class Name</label>
                <input type="text" id="class_name" name="class_name" value="{{ old('class_name') }}" class="form-control" required>
            </div>
        </div>

        <div class="col-md-12 mt-4 text-center">
            <button type="submit" id="checkBtn" class="btn btn-primary px-4 py-2 font-bold rounded focus:outline-none focus:shadow-outline">
                Create Class
            </button>
        </div>

        <p id="message" class="mt-2 font-bold"></p>
    </form>
</div>
@endsection
{{-- 
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#checkBtn').on('click', function(e) {
        e.preventDefault(); // prevent default submit

        let className = $('#class_name').val();
        $('#message').text('Checking...').css('color', 'blue');

        $.ajax({
            url: '{{ route('admin.check_class_name') }}',
            type: 'GET',
            data: { class_name: className },
            success: function(response) {
                if(response.exists) {
                    $('#message').text('❌ Class name already exists. Please choose another.').css('color', 'red');
                } else {
                    $('#message').text('✅ Class name is available. Submitting...').css('color', 'green');
                    // Submit form manually
                    $('#classForm').submit();
                }
            },
            error: function() {
                $('#message').text('⚠️ Error checking class name. Please try again.').css('color', 'orange');
            }
        });
    });
</script>
@endsection --}}
