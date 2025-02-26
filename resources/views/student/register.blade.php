@extends('student.layouts.app')
@section('title',__('common.subject'))
@section('content')
<div class="table-wrapper">
        <h2>{{ __('common.register') }}</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('student.register.store') }}" method="GET" class="row g-1">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Chon</th>
                    <th>ID</th>
                    <th>{{ __('common.department_name') }}</th>
                    <th>{{ __('common.status') }}</th>
                    <th>{{ __('common.action') }}</th>      
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>
                        <input type="checkbox"  name="subject_id_{{$subject->id}}" value="{{ $subject->id }}" />
                    </td>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>
                    <button class="btn btn-danger btn-sm" >
                    </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">{{ __('common.filter') }}</button>
                    </div>
        </form>
    </div>
@endsection