@extends('student.layouts.app')
@section('title',__('common.subject'))
@section('content')
<div class="table-wrapper">
    <h2>{{ __('common.register') }}</h2>
    <form action="{{ route('student.register.store') }}" method="GET" class="row g-1">
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-success w-50 ">
                {{ __('common.register') }}
            </button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{__('common.select')}}</th>
                    <th>ID</th>
                    <th>{{ __('common.subject_name') }}</th>
                    <th>{{ __('common.description') }}</th>
                    <th>{{ __('common.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>
                        <input type="checkbox" name="subject_id_{{$subject['id']}}" value="{{ $subject['id'] }}"
                            {{ $subject['status'] === 'registered' ? 'disabled' : '' }} />
                    </td>
                    <td>{{ $subject['id'] }}</td>
                    <td>{{ $subject['name'] }}</td>
                    <td>{{ $subject['description'] }}</td>
                    <td>
                        <div class="btn {{ $subject['color']}} btn-sm">{{ __('common.' . $subject['status']) }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection