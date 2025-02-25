@extends('admin.layouts.app')
@section('title',__('common.management.department'))
@section('content')
<div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="modal-title">{{ __('common.edit') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.department.update', ['id'=>$department->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('common.department_name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $department->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('common.description') }}</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ $department->description }}">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                    
                    <div class="text-end">
                        <a href="{{ route('admin.department.index') }}" class="btn btn-secondary">{{ __('common.cancel') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('common.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
