<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- ===============================
             SECTIONS
             Module: Sections
             Permission required: Sections.showSections
        ================================ -->
        @if (\App\Helpers\RoleHelper::isAuthorized('Sections.showSections'))
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('sections.*') ? '' : 'collapsed' }}"
                    href="{{ route('sections.index') }}">
                    <i class="bi bi-folder"></i>
                    <span>Sections</span>
                </a>
            </li>
        @endif


        <!-- ===============================
             COURSES
             Module: Courses
             Permission required: Courses.showCourses
        ================================ -->
        @if (\App\Helpers\RoleHelper::isAuthorized('Courses.showCourses'))
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('courses.*') ? '' : 'collapsed' }}"
                    href="{{ route('courses.index') }}">
                    <i class="bi bi-book"></i>
                    <span>Courses</span>
                </a>
            </li>
        @endif


        <!-- ===============================
             ENROLLMENTS
             Module: Enrollments
             Permission required: Enrollments.showEnrollments
        ================================ -->
        @if (\App\Helpers\RoleHelper::isAuthorized('Enrollments.showEnrollments'))
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('enrollments.*') ? '' : 'collapsed' }}"
                    href="{{ route('enrollments.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Enrollments</span>
                </a>
            </li>
        @endif


        <!-- ===============================
             USERS
             Module: Users
             Permission required: Users.showUsers
        ================================ -->
        @if (\App\Helpers\RoleHelper::isAuthorized('Users.showUsers'))
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('users.*') ? '' : 'collapsed' }}"
                    href="{{ route('users.create') }}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif


        <!-- ===============================
             ROLES
             Module: Roles
             Permission required: Roles.showRoles
        ================================ -->
        @if (\App\Helpers\RoleHelper::isAuthorized('Roles.showRoles'))
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('roles.*') ? '' : 'collapsed' }}"
                    href="{{ route('roles.index') }}">
                    <i class="bi bi-shield-lock"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endif

    </ul>

</aside>
