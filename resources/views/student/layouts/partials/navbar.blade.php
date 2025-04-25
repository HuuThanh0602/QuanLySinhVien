<nav class="navbar-expand-lg navbar-light bg-light shadow-lg" style="height:1050px;width:200px">

    <ul class="navbar-nav d-flex flex-column p-2">
        <li class="nav-item " style=" margin: 10px 0 20px 0;">
            <form action="{{ route('locale.change') }}" method="POST" class="mb-2">
                @csrf
                <select name="locale" class="form-select w-100" onchange="this.form.submit()" style="width: 150px;">
                    <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                </select>
            </form>
        </li>
        <li class="nav-item ">
            <a class="navbar-brand" href="#">
                <h4>{{__('common.management.management')}}</h4>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('student.profile.index')}}">{{__('common.home')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('student.profile.index')}}">{{__('common.profile')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('student.register.index')}}">{{__('common.register')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('student.result.index')}}">{{__('common.result')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('chat')}}">{{__('common.chat')}}</a>
        </li>
    </ul>
    <div class="d-flex" style="margin-top: 50px;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">{{__('common.logout')}}</button>
        </form>
    </div>
</nav>