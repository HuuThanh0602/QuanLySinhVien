<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Thesis</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet"> 


    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <style>
        body {
            background-color: #f8f9fa; 
            font-family: Arial, sans-serif;
        }

        .card {
            border-radius: 0.5rem; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }
        
        .card-header {
            background-color: #007bff;
            color: white; 
            text-align: center; 
            border-top-left-radius: 0.5rem; 
            border-top-right-radius: 0.5rem; 
        }

        .form-control {
            border-radius: 0.25rem; 
            border: 1px solid #ced4da; 
        }

        .form-control:focus {
            border-color: #007bff; 
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); 
        }

        .btn-secondary {
            background-color: #6c757d; 
        }

        .btn-success {
            background-color: #28a745; 
        }

        .btn-secondary:hover, .btn-success:hover {
            opacity: 0.8; 
        }
    </style>
</head>

<body>
    <div class="container">
    
        <div class="card">
            <div class="card-header">
                <h4 class="modal-title">{{__('common.add_new')}}</h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('admin.student.store') }}" method="POST">
                    @csrf                  
                    <div class="form-group">
                        <label for="name">{{__('common.name')}}</label>
                        <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name"  >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('common.email')}}</label>
                        <input type="text"  class="form-control @error('email') is-invalid @enderror" id="email" name="email"  >
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="day_of_birth">{{__('common.day_of_birth')}}</label>
                        <input type="date"  class="form-control @error('day_of_birth') is-invalid @enderror" id="day_of_birth" name="day_of_birth"  >
                        @error('day_of_birth')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">{{__('common.gender')}}</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender ">
                            <option value="" ></option>
                            <option value="Male">{{__('common.male')}}</option>
                            <option value="Female">{{__('common.female')}}</option>
                        </select>
                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{__('common.address')}}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" >
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripti">{{__('common.phone')}}</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" >
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="department">{{__('common.department')}}</label>
                        <select class="form-control @error('department') is-invalid @enderror" name="department" id="department">
                            <option value="" ></option>
                            @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                    <div class="modal-footer">
                        <a href="{{ route('admin.student.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
