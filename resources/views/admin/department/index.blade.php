<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quản Lý Đồ Án</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet"> 
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> 
    <style>
        body {
		    background: #f5f5f5;
		    font-family: 'Varela Round', sans-serif;
		    font-size: 13px; 
		    margin: 0;
		}

		.table-wrapper {
		    background: #fff; 
		    padding: 20px; 
		    border-radius: 5px; 
		    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
		}

		.table-title {
		    background: #435d7d; 
		    color: #fff; 
		    padding: 20px 30px; 
		    border-radius: 5px; 
		    display: flex;
		    justify-content: space-between; 
		    align-items: center; 
		}

		.table-title h2 {
		    margin: 0;
		    font-size: 26px; 
		}

		table.table {
		    width: 100%;
		    margin-top: 20px;
		    border-collapse: collapse; 
		}

		table.table th, table.table td {
		    padding: 15px; 
		    border: 1px solid #e9e9e9; 
		}

		table.table th {
		    background: #f8f8f8; 
		    text-align: left; 
		}

		td a {
		    margin-right: 5px; 
		    display: inline-block;
		    text-align: center;
		}

		i {
		    font-size: 22px; 
		}

		.delete-icon {
		    color: #F44336; 
		}

		.edit-icon {
		    color: #FFC107;
		}

		.button {
		    display: flex;                 
		    justify-content: center;       
		    align-items: center;            
		    gap: 15px; 
		    margin-top: 15px; 
		}
		.pagination {
		    display: flex;
		    justify-content: center;
		    margin: 20px 0;
		}

		.pagination li {
		    list-style: none;
		}

		.pagination li a {
		    border: 1px solid #e9e9e9;
		    font-size: 14px;
		    min-width: 36px;
		    min-height: 36px;
		    color: #999;
		    margin: 0 4px;
		    line-height: 36px;
		    border-radius: 5px;
		    text-align: center;
		    padding: 0 10px;
		    transition: 0.3s;
		}

		.pagination li a:hover,
		.pagination li a.page-number:hover {
		    color: #fff;
		    background: #03A9F4;
		}

		.pagination li.active a {
		    background: #03A9F4;
		    color: #fff;
		}

		.pagination li.active a:hover {
		    background: #0397d6;
		}

		.pagination li.disabled a {
		    color: #ccc;
		    cursor: not-allowed;
		}

		.pagination li i {
		    font-size: 16px;
		    padding-top: 6px;
		}

		.pagination li a.page-number {
		    font-weight: bold;
		    color: #333;
		}
    </style>
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="main">
        <div class="table-wrapper">
            <div class="table-title">
                <h2>Quản Lý Khoa</h2>
                <div class="button">
                    <a href="{{route('admin.department.create')}}" class="btn btn-success">
                        <i class="bi bi-plus-circle-fill"></i> <span>Thêm mới</span>
                    </a>                  
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã Khoa</th>
                        <th>Tên Khoa</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>		
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->description }}</td>
                        <td >
                            <a href="{{route('admin.department.edit',['id'=>$department->id])}}">
                                <i class="bi bi-pencil-fill edit-icon"></i>
                            </a>
                            <form action="{{route('admin.department.destroy',['id'=>$department->id])}}" method="post" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này?');" 
                                  style="display: inline-block; margin-left: 5px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
                                    <i class="bi bi-trash3-fill delete-icon"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
			{{ $departments->links('pagination::bootstrap-4') }}
			
        </div>
    </div>
</body>
</html>
