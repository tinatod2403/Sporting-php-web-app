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
                <a href="{{ route('moderator.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['complexes', 'complexes/*']) }}">
                <a href="{{ route('moderator.complexes.edit',['complex'=>auth()->guard('moderator')->user()->complex->id]) }}"
                   class="nav-link">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Complex</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['reservations', 'reservations/*']) }}">
                <a href="{{ route('moderator.reservations.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Reservations</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['courts', 'courts/*']) }}">
                <a href="{{ route('moderator.courts.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Courts</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['news', 'news/*']) }}">
                <a href="{{ route('moderator.news.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">News</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
