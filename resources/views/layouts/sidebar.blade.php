<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- Elemento Secciones (Visible para todos temporalmente) --}}
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('section.*') ? '' : 'collapsed' }}" href="{{ route('sections.index') }}">
                <i class="bi bi-grid"></i>
                <span>Sections</span>
            </a>
        </li>

        {{-- Elemento Blogs (Visible para todos temporalmente) --}}
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('course.*') ? '' : 'collapsed' }}" href="{{ route('courses.index') }}">
                <i class="bi bi-grid"></i>
                <span>Courses</span>
            </a>
        </li>



        {{-- Elemento Roles (Visible para todos temporalmente) --}}
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('user.*') ? '' : 'collapsed' }}" href="{{ route('users.create') }}">
                <i class="bi bi-lock"></i>
                <span>Users</span>
            </a>
        </li>

    </ul>

</aside>
