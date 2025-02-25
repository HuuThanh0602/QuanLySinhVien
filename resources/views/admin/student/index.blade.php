@extends('admin.layouts.app')
@section('title',__('common.management.student'))
@section('content')
<div class="table-wrapper">
    <div class="table-title">
        <h2>{{__('common.management.student')}}</h2>
		@if (session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			{{ session('success') }}
			<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif
        <div class="mb-3">
            <a href="{{route('admin.student.create')}}" class="btn btn-success">
                {{__('common.add_new')}}
            </a>                  
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{__('common.name')}}</th>
                <th>{{__('common.day_of_birth')}}</th>
                <th>{{__('common.gender')}}</th>
				<th>{{__('common.email')}}</th>
				<th>{{__('common.description')}}</th>
				<th>{{__('common.address')}}</th>
				<th>{{__('common.phone')}}</th>	
				<th>{{__('common.action')}}</th>	
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{$student->id }}</td>
                <td>{{$student->full_name }}</td>
                <td>{{$student->day_of_birth }}</td>
				<td>{{$student->gender}}</td>
				<td>{{$student->user->email}}</td>
				<td>{{$student->department->name}}</td>
				<td>{{$student->address}}</td>
				<td>{{$student->phone}}</td>
                <td>
                    <a href="{{ route('admin.student.edit', ['id' => $student->id]) }}" class="btn btn-warning btn-sm">
                        Sửa
                    </a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $student->id }}">
                        Xóa
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
	{{ $students->links('pagination::bootstrap-4') }}
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
            form.action = '/admin/student/'+id+'/destroy';
        });
    </script>
@endsection
