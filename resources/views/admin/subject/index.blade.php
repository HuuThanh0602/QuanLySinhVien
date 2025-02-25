@extends('admin.layouts.app')
@section('title',__('common.management.subject'))
@section('content')
<div class="main">
    <div class="table-wrapper">
        <div class="table-title">
            <h2>{{__('common.management.subject')}}</h2>
			@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }}
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
            <div class="button">
                <a href="{{route('admin.subject.create')}}" class="btn btn-success">
                    {{__('common.add_new')}}
                </a>                  
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('common.subject_name')}}</th>
                    <th>{{__('common.description')}}</th>
                    <th>{{__('common.action')}}</th>		
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->description }}</td>
                    <td>
						<a href="{{ route('admin.subject.edit', ['id' => $subject->id]) }}" class="btn btn-warning btn-sm">
							Sửa
						</a>
						<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $subject->id }}">
							Xóa
						</button>
					</td>
                </tr>
                @endforeach
            </tbody>
        </table>
		{{ $subjects->links('pagination::bootstrap-4') }}
		
    </div>
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
            form.action = '/admin/subject/'+id+'destroy/';
        });
    </script>
@endsection