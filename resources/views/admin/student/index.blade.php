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
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.student.create') }}" class="btn btn-success">
                {{ __('common.add_new') }}
            </a>
            <div class="mb-2" style="width:70%">
                <form action="{{ route('admin.student.index') }}" method="GET" class="row g-1">
                    <div class="col-md-3">
                        <label for="age_from" class="form-label">{{ __('common.age_from') }}</label>
                        <input type="number" name="age_from" id="age_from" class="form-control" 
                            value="{{ request('age_from') }}" placeholder="{{ __('common.age_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="age_to" class="form-label">{{ __('common.age_to') }}</label>
                        <input type="number" name="age_to" id="age_to" class="form-control" 
                            value="{{ request('age_to') }}" placeholder="{{ __('common.age_to') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('common.phone_carrier') }}</label>
                        <select name="carrier" class="form-select">
                            <option value="">{{ __('common.all_carriers') }}</option>
                            <option value="viettel" {{ request('carrier') == 'viettel' ? 'selected' : '' }}>Viettel</option>
                            <option value="mobi" {{ request('carrier') == 'mobi' ? 'selected' : '' }}>Mobifone</option>
                            <option value="vina" {{ request('carrier') == 'vina' ? 'selected' : '' }}>Vinaphone</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('common.finished_level') }}</label>
                        <select name="finished_level" class="form-select">
                            <option value="">----</option>
                            <option value="finished" {{ request('finished_level') == 'finished' ? 'selected' : '' }}>{{__('common.finished')}}</option>
                            <option value="unfinished" {{ request('finished_level') == 'unfinished' ? 'selected' : '' }}>{{__('common.unfinished')}}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="score_from" class="form-label">{{ __('common.score_from') }}</label>
                        <input type="number" name="score_from" id="score_from" class="form-control" 
                            value="{{ request('score_from') }}" placeholder="{{ __('common.score_from') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="score_to" class="form-label">{{ __('common.score_to') }}</label>
                        <input type="number" name="score_to" id="score_to" class="form-control" 
                            value="{{ request('score_to') }}" placeholder="{{ __('common.score_to') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">{{ __('common.filter') }}</button>
                    </div>
                </form>
            </div>
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
