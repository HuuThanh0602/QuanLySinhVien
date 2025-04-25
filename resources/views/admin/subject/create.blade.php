@extends('admin.layouts.app')
@section('title',__('common.management.subject'))
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h4 class="modal-title">{{(__('common.add_new'))}}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subject.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{__('common.subject_name')}} <span div style="color:red">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                    @error('name') {{ $message }} @enderror
                </div>
                <div class="form-group">
                    <label for="description">{{__('common.description')}}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{old('description')}}">
                    @error('description') {{ $message }} @enderror
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.subject.index') }}" class="btn btn-secondary">{{__('common.cancel')}}</a>
                    <button type="submit" class="btn btn-success">{{__('common.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection