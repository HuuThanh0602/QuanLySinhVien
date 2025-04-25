<nav class="navbar-expand-lg navbar-light bg-light shadow-lg" style="height:1050px;">

    <ul class="navbar-nav d-flex flex-column p-2">
        <li class="nav-item " style="margin: 10px 0 20px 0;">
            <form action="{{ route('locale.change') }}" method="POST" class="mb-2">
                @csrf
                <select name="locale" class="form-select w-100" onchange="this.form.submit()">
                    <option value="vi" {{ app()->getLocale() == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                </select>
            </form>
        </li>
        <li class="nav-item">
            <a class="navbar-brand" href="#">
                <h4>{{ __('common.management.management') }}</h4>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">{{ __('common.home') }}</a>
        </li>

        @can('manage students')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.student.index') }}">{{ __('common.management.student') }}</a>
        </li>
        @endcan

        @can('manage departments')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.department.index') }}">{{ __('common.management.department') }}</a>
        </li>
        @endcan

        @can('manage subjects')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.subject.index') }}">{{ __('common.management.subject') }}</a>
        </li>
        @endcan

        @can('manage results')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.result.index') }}">{{ __('common.management.result') }}</a>
        </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" href="{{ route('chat') }}">{{ __('common.chat') }}</a>
        </li>
        @can('manage users')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" href="#" id="userDropdown" role="button">
                {{ __('common.management.user') }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                        {{ __('common.management.user') }}
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request()->routeIs('admin.role.index') ? 'active' : '' }}" href="{{ route('admin.role.index') }}">
                        {{ __('common.management.role') }}
                    </a>
                </li>
            </ul>
        </li>

        @endcan
        <li class="nav-item" style="margin-top: 50px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">{{__('common.logout')}}</button>
            </form>
        </li>
    </ul>
</nav>
<style>
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }
</style>