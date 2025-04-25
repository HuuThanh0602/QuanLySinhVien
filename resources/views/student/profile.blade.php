@extends('student.layouts.app')
@section('title',__('common.profile'))
@section('content')
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body text-center">
            <img src="{{ asset('storage/' . $infor['avatar'] ?? 'avatars/avatar.png') }}" alt="Avatar" class="img-fluid rounded-circle" style="width: 150px; height: 150px; ">
            <h3 class="card-title">{{$infor['full_name']}}</h3>
            <table class="table table-bordered mt-3">
                <tbody>
                    <tr>
                        <th scope="row">ID:</th>
                        <td>{{$infor['id']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{__('common.department')}}</th>
                        <td>{{$infor['department']['name']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{__('common.email')}}</th>
                        <td>{{$infor['user']['email']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{__('common.phone')}}</th>
                        <td>{{$infor['phone']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{__('common.address')}}</th>
                        <td>{{$infor['address']}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-3">
                <form action="{{route('student.profile.upload',['id'=>$infor->id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="file" name="image" id="image">
                    <button type="submit" class="btn btn-primary">{{__('common.save')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection