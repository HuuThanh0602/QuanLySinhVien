@extends('admin.layouts.app')
@section('title',__('common.management.department'))
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h4>{{ __('common.add_new') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.department.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('common.department_name') }}
                        <span div style="color:red">*</span>
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                    @error('name') {{ $message }} @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('common.description') }}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{old('description')}}">
                    @error('description') {{ $message }} @enderror
                </div>
                <div class="d-flex  justify-content-end">
                    <a href="{{ route('admin.department.index') }}" class="btn btn-secondary ">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-success">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection