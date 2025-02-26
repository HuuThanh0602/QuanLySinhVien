@extends('student.layouts.app')
@section('title',__('common.profile'))
@section('content')
<div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrWGnkEWaaNZjJTYAVRWZwi1ehw0muzeOnwg&s" class="rounded-circle mb-3" alt="Ảnh đại diện">
                <h3 class="card-title">Nguyễn Văn A</h3>
                <p class="text-muted">Sinh viên ngành Công Nghệ Thông Tin</p>
                
                <table class="table table-bordered mt-3">
                    <tbody>
                        <tr>
                            <th scope="row">ID:</th>
                            <td>SV123456</td>
                        </tr>
                        <tr>
                            <th scope="row">Khoa:</th>
                            <td>Công Nghệ Thông Tin</td>
                        </tr>
                        <tr>
                            <th scope="row">Email:</th>
                            <td>nguyenvana@example.com</td>
                        </tr>
                        <tr>
                            <th scope="row">Số điện thoại:</th>
                            <td>0123 456 789</td>
                        </tr>
                        <tr>
                            <th scope="row">Địa chỉ:</th>
                            <td>123 Đường ABC, Hà Nội</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3">
                    <a href="#" class="btn btn-primary">Upload ảnh</a>
                </div>
            </div>
        </div>
    </div>

@endsection