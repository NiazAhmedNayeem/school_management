@extends('backend.layouts.master')
@section('title', 'Admin | All Classes')

@section('main-content')


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
                        <th>Slug</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $school_class)
                        <tr>
                            <td>{{ $school_class->class_name }}</td>
                            <td>{{ $school_class->slug }}</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input status-radio" name="status_{{ $school_class->id }}" value="1" data-id="{{ $school_class->id }}" {{ $school_class->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input status-radio" name="status_{{ $school_class->id }}" value="0" data-id="{{ $school_class->id }}" {{ $school_class->status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label">Inactive</label>
                                </div>
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


@endsection

@section('scripts')

{{-- ✅ DataTable --}}
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>

{{-- ✅ Status AJAX --}}
<script>
    $(document).ready(function() {
        $('.status-radio').on('change', function() {
            let id = $(this).data('id');
            let status = $(this).val();

            $.ajax({
                url: '{{ route("admin.update_class_status") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message, 'Success', { timeOut: 3000 });
                    } else {
                        toastr.error(response.message, 'Error', { timeOut: 3000 });
                    }
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!', 'Error', { timeOut: 3000 });
                }
            });
        });
    });
</script>

@endsection
