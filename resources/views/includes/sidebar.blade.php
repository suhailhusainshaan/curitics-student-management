<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="./index.html" class="brand-link">
            <img
              src="{{asset('/assets/img/logo-dark.png')}}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            @if($user_role == 1)
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item menu-open">
                <a href="{{route('admin.dashboard')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('admin.students')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Student
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('admin.courses')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Course
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('admin.enrollments')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Enrollments
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('custom-logout')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>

            </ul>
            @elseif($user_role == 2)
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item menu-open">
                <a href="{{route('student.dashboard')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('student.courses')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Course
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('student.enrollment')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Enrollments
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{route('custom-logout')}}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>

            </ul>
            @endif
          </nav>
        </div>
      </aside>