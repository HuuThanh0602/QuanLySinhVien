@extends('admin.layouts.app')
@section('title',__('common.home'))
@section('content')

<head>
    <style>
        .square {
            width: 100%;
            padding-top: 100%;
            position: relative;
            background-color: #457b9d;
            font-size: 30px;
            color: white;
            text-align: center;
        }

        .square span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            white-space: normal;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="row row-cols-4 g-2">
            <div class="col">
                <a href="">
                    <div class="square"><span>{{__('common.home')}}</span></div>
                </a>
            </div>
            @can('manage students')
            <div class="col">
                <a href="{{route('admin.student.index')}}">
                    <div class="square"><span>{{__('common.management.student')}}</span></div>
                </a>
            </div>
            @endcan

            @can('manage departments')
            <div class="col">
                <a href="{{route('admin.department.index')}}">
                    <div class="square"><span>{{__('common.management.department')}}</span></div>
                </a>
            </div>
            @endcan

            @can('manage subjects')
            <div class="col">
                <a href="{{route('admin.subject.index')}}">
                    <div class="square"><span>{{__('common.management.subject')}}</span></div>
                </a>
            </div>
            @endcan

            @can('manage results')
            <div class="col">
                <a href="{{route('admin.result.index')}}">
                    <div class="square"><span>{{__('common.management.result')}}</span></div>
                </a>
            </div>
            @endcan
            @can('manage users')
            <div class="col">
                <a href="{{route('admin.user.index')}}">
                    <div class="square"><span>{{__('common.management.user')}}</span></div>
                </a>
            </div>
            @endcan
        </div>
    </div>
</body>
@endsection