@extends('admin.layouts.app')
@section('title',__('common.management.result'))
@section('content')
<div class="table-wrapper">
    <div class="d-flex justify-content-between">
        <h2>{{ __('common.management.result') }}</h2>
        <form action="{{route('admin.result.importExcel')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="file" class="" name="file_excel" id="file_excel">
            <button type="submit" class="btn btn-success">nhập điểm</button>
        </form>
        <a href="{{route('admin.result.updateScore')}}" type="button">Sửa điểm cho sinh viên thấp điểm</a>
    </div>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('common.full_name')}}</th>
                <th>{{ __('common.number_learned')}}</th>
                <th>{{ __('common.gpa')}}</th>
                <th>{{ __('common.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{$student['id']}}</td>
                <td>{{$student['full_name']}}</td>
                <td>{{$student['count']}}</td>
                <td>{{ $student['gpa'] !== null ? number_format($student['gpa'], 2) : __('common.no_point') }}</td>
                <td>
                    <a href="{{ route('admin.result.show', ['id' => $student['id']]) }}" class="btn btn-warning btn-sm">
                        {{ __('common.detail')}}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection