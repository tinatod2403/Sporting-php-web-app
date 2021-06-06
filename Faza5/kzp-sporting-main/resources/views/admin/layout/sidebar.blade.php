<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            {{ config('app.name') }}
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item {{ active_class(['dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['admins', 'admins/*', 'customers', 'customers/*', 'moderators', 'moderators/*']) }}">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button"
                   aria-expanded="{{ is_active_route(['admins', 'customers', 'moderators']) }}" aria-controls="users">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div
                    class="collapse {{ show_class(['admins', 'admins/*', 'customers', 'customers/*', 'moderators', 'moderators/*']) }}"
                    id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('admin.admins.index')}}"
                               class="nav-link {{ active_class(['admins','admins/*']) }}">
                                Admins
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.customers.index')}}"
                               class="nav-link {{ active_class(['customers','customers/*']) }}">
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.moderators.index')}}"
                               class="nav-link {{ active_class(['moderators','moderators/*']) }}">
                                Moderators
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['categories', 'categories/*']) }}">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Categories</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
