@extends('admin.layouts.app')

@section('title', __('common.management.department'))

@section('content')
    <div class="table-wrapper">
        <h2>{{ __('common.management.department') }}</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('admin.department.create') }}" class="btn btn-success">
                {{ __('common.add_new') }}
            </a>                  
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('common.department_name') }}</th>
                    <th>{{ __('common.description') }}</th>
                    <th>{{ __('common.action') }}</th>      
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->description }}</td>
                    <td>
                        <a href="{{ route('admin.department.edit', ['id' => $department->id]) }}" class="btn btn-warning btn-sm">
                            Sửa
                        </a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $department->id }}">
                            Xóa
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $departments->links('pagination::bootstrap-4') }}
    </div>

@include('admin.layouts.partials.modal_delete')
@endsection

@section('scripts')
    <script>
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var form = document.getElementById('deleteForm');
            form.action = '/admin/department/'+id+'/destroy';
        });
    </script>
@endsection
