<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{__('common.management.management')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.student.index')}}">{{__('common.management.student')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.department.index')}}">{{__('common.management.department')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.subject.index')}}">{{__('common.management.subject')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">{{__('common.management.result')}}</a>
                </li>
            </ul>
            <div class="d-flex">
                <form action="" class="me-2">
                    @csrf
                    <select name="locale" class="form-select" style="width: 150px;">
                        <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </form>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">{{__('common.logout')}}</button>
                </form>
            </div>
        </div>
    </div>
</nav>
