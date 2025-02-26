@extends('admin.layouts.app')
@section('title',__('common.management.student'))
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h4 class="modal-title">{{__('common.edit')}}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.student.update',['id'=>$student->id]) }}" method="POST">
                @csrf
				@method('PUT')                   
                <div class="form-group">
                    <label for="name">{{__('common.name')}}</label>
                    <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$student->full_name}}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{__('common.email')}}</label>
                    <input type="text"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$student->user->email}}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="day_of_birth">{{__('common.day_of_birth')}}</label>
                    <input type="date"  class="form-control @error('day_of_birth') is-invalid @enderror" id="day_of_birth" name="day_of_birth" value="{{$student->day_of_birth}}">
                    @error('day_of_birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">{{__('common.gender')}}</label>
                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
						<option value="Male" {{$student->gender=='Male'?'selected':''}}>{{__('common.male')}}</option>
                        <option value="Female" {{$student->gender=='Female'?'selected':''}}>{{__('common.female')}}</option>
                    </select>
                    @error('gender')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">{{__('common.address')}}</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{$student->address}}" >
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="descripti">{{__('common.phone')}}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{$student->phone}}" >
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="department">{{__('common.department')}}</label>
                    <select class="form-control @error('department') is-invalid @enderror" name="department" id="department">
                        @foreach($departments as $department)
                        <option value="{{$department->id}}"{{$department->id==$student->department_id?'selected':''}}>{{$department->name}}</option>
                        @endforeach
                    </select>
                    @error('department')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> 
                <div class="text-end">
                    <a href="{{ route('admin.student.index') }}" class="btn btn-secondary ">{{ __('common.cancel') }}</a>
                    <button type="submit" class="btn btn-success">{{ __('common.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
