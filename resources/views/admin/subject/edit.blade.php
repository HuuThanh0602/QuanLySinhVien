@extends('admin.layouts.app')
@section('title',__('common.management.subject'))
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="modal-title">{{ __('common.edit') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subject.update',['id'=>$subject->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">{{__('common.subject_name')}} <span div style="color:red">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name',$subject['name'])}}">
                    @error('name') {{ $message }} @enderror
                </div>
                <div class="form-group">
                    <label for="description">{{__('common.description')}}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{old('description'),$subject['description']}}">
                    @error('description') {{ $message }} @enderror
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.subject.index') }}" class="btn btn-secondary">{{__('common.cancel')}}</a>
                    <button type="submit" class="btn btn-success">{{__('common.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection