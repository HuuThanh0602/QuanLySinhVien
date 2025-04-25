@extends('admin.layouts.app')
@section('title',__('common.management.student'))
@section('content')
<div class="container mt-4 ">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h4>{{ __('common.add_new') }} </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.student.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="full_name">{{__('common.full_name')}} <span div style="color:red">*</span></label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{old('full_name')}}">
                    @error('full_name'){{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{__('common.email')}} <span div style="color:red">*</span></label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                    @error('email'){{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="day_of_birth">{{__('common.day_of_birth')}} <span div style="color:red">*</span></label>
                    <input type="date" class="form-control @error('day_of_birth') is-invalid @enderror" id="day_of_birth" name="day_of_birth" value="{{old('day_of_birth')}}">
                    @error('day_of_birth'){{ $message }}@enderror
                </div>
                <div class="form-group">
                    <label for="gender">{{__('common.gender')}} <span div style="color:red">*</span></label>
                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                        <option value=""></option>
                        <option value="Male" {{old('gender') == 'Male' ? 'selected' : ''}}>{{__('common.male')}}</option>
                        <option value="Female" {{old('gender') == 'Female' ? 'selected' : ''}}>{{__('common.female')}}</option>
                    </select>
                    @error('gender'){{ $message }}@enderror
                </div>
                <div class="form-group">
                    <label for="address">{{__('common.address')}} <span div style="color:red">*</span></label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')}}">
                    @error('address'){{ $message }}@enderror
                </div>
                <div class="form-group">
                    <label for="descripti">{{__('common.phone')}} <span div style="color:red">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{old('phone')}}">
                    @error('phone'){{ $message }}@enderror
                </div>
                <div class="form-group">
                    <label for="department_id">{{ __('common.department') }} <span div style="color:red">*</span></label>
                    <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
                        <option value=""></option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('department_id'){{ $message }}
                    @enderror
                </div>
                <input type="checkbox" name="slq1" />
                <div class="modal-footer">
                    <a href="{{ route('admin.student.index') }}" class="btn btn-secondary m-2">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-success">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection