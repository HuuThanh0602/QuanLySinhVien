@extends('student.layouts.app')
@section('title',__('common.result'))
@section('content')
<div class="table-wrapper">
    <h2>{{ __('common.result') }}</h2>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('common.department_name') }}</th>
                <th>{{ __('common.status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result['subject_id'] }}</td>
                <td>{{ $result['subject_name'] }}</td>
                <td>{{ $result['score'] !== null ? number_format($result['score'], 2) : __('common.no_point') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <span><strong>GPA:</strong> {{$gpa}}</span>
</div>
@endsection