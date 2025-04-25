<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('common.login')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@include('layouts.modal_alert')

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div style="top:10px;right:30px; position:fixed">
        <form action="{{ route('locale.change') }}" method="POST" class="mb-2">
            @csrf
            <select name="locale" class="form-select w-100" onchange="this.form.submit()">
                <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            </select>
        </form>
    </div>
    <div class="card shadow p-4" style="width: 400px;">
        <h4 class="text-center mb-4">{{__('common.login')}}</h4>
        <form action="{{ route('login_') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{__('common.email')}}</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{__('common.password')}}</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">{{__('common.login')}}</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>