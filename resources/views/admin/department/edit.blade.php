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
                <h4 class="modal-title">Thêm mới</h4>
            </div>
            
            <div class="card-body">
                <form action="{{ route('admin.department.update', ['id'=>$department->id]) }}" method="POST">
                    @csrf
                    @method('PUT')                
                    <div class="form-group">
                        <label for="name">Tên Khoa</label>
                        <input type="text"  class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$department->name}}" >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value = "{{$department->description}}" >
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                    <div class="modal-footer">
                        
                        <a href="{{ route('admin.department.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>
