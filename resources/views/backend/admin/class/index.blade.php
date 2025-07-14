@extends('backend.layouts.master')
@section('title', 'Admin | All Classes')


@section('main-content')

<div class="container-fluid px-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mt-4">All Classes Information</h1>
        </div>
        <div>
            <a href="{{ route('admin.add_class') }}" class="mt-4 btn btn-primary">Add New Class</a>
        </div>
    </div>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Class List</li>
    </ol>

    {{-- ✅ Success Message --}}
    @if (session('success'))
        <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fixed top-5 right-5 shadow-lg z-50" role="alert">
            <strong class="font-bold">✅ Success! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            All Class List
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $school_class)
                        <tr>
                            <td>{{ $school_class->class_name }}</td>
                            <td>
                                <span class="badge {{ $school_class->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $school_class->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.edit_class', $school_class->id) }}" class="btn btn-success btn-sm">Edit</a>
                                <form action="{{ route('admin.delete_class', $school_class->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this class?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        // window.addEventListener('DOMContentLoaded', event => {
        //     const datatablesSimple = document.getElementById('datatablesSimple');
        //     if (datatablesSimple) {
        //         new simpleDatatables.DataTable(datatablesSimple);
        //     }
        // });

        // Success message auto hide after 5 seconds
       
         setTimeout(function() {
            let msg = document.getElementById('successMessage');
            if (msg) {
                msg.style.transition = 'opacity 0.5s';
                msg.style.opacity = '0';
                setTimeout(() => {
                    msg.style.display = 'none';
                }, 500);
            }
        }, 5000);
    </script>
@endsection
