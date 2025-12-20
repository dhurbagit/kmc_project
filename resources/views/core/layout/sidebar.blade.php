 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Departmant</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Departmant Components:</h6>
                        <a class="collapse-item" href="{{ route('departments.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('departments.index') }}">List View</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSector"
                    aria-expanded="true" aria-controls="collapseSector">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sector</span>
                </a>
                <div id="collapseSector" class="collapse" aria-labelledby="headingSector" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sector Components:</h6>
                        <a class="collapse-item" href="{{ route('sectors.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('sectors.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubSector"
                    aria-expanded="true" aria-controls="collapseSubSector">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sub Sector</span>
                </a>
                <div id="collapseSubSector" class="collapse" aria-labelledby="headingSubSector" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sub Sector Components:</h6>
                        <a class="collapse-item" href="{{ route('sub-sectors.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('sub-sectors.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemain_program"
                    aria-expanded="true" aria-controls="collapsemain_program">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Main Program</span>
                </a>
                <div id="collapsemain_program" class="collapse" aria-labelledby="headingmain_program" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Main Program Components:</h6>
                        <a class="collapse-item" href="{{ route('main-programs.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('main-programs.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseprograms"
                    aria-expanded="true" aria-controls="collapseprograms">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Program</span>
                </a>
                <div id="collapseprograms" class="collapse" aria-labelledby="headingprograms" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Main Program Components:</h6>
                        <a class="collapse-item" href="{{ route('programs.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('programs.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-program-budgets"
                    aria-expanded="true" aria-controls="collapse-program-budgets">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Program Budgets</span>
                </a>
                <div id="collapse-program-budgets" class="collapse" aria-labelledby="heading-program-budgets" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Program Budgets Components:</h6>
                        <a class="collapse-item" href="{{ route('program-budgets.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('program-budgets.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-Indicator"
                    aria-expanded="true" aria-controls="collapse-Indicator">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Indicator</span>
                </a>
                <div id="collapse-Indicator" class="collapse" aria-labelledby="heading-Indicator" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Indicator Components:</h6>
                        <a class="collapse-item" href="{{ route('indicators.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('indicators.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-ProgramIndicatorLink"
                    aria-expanded="true" aria-controls="collapse-ProgramIndicatorLink">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Program Indicator Link</span>
                </a>
                <div id="collapse-ProgramIndicatorLink" class="collapse" aria-labelledby="heading-ProgramIndicatorLink" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Indicator Components:</h6>
                        <a class="collapse-item" href="{{ route('program-indicator-links.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('program-indicator-links.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-evaluations"
                    aria-expanded="true" aria-controls="collapse-evaluations">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Evaluations</span>
                </a>
                <div id="collapse-evaluations" class="collapse" aria-labelledby="heading-evaluations" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Indicator Components:</h6>
                        <a class="collapse-item" href="{{ route('evaluations.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('evaluations.index') }}">List View</a>
                    </div>
                </div>
            </li>
            <li class="nav-item"> 
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-kpi-snapshots"
                    aria-expanded="true" aria-controls="collapse-kpi-snapshots">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kpi Snapshots</span>
                </a>
                <div id="collapse-kpi-snapshots" class="collapse" aria-labelledby="heading-kpi-snapshots" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Indicator Components:</h6>
                        <a class="collapse-item" href="{{ route('kpi-snapshots.create') }}">Create New</a>
                        <a class="collapse-item" href="{{ route('kpi-snapshots.index') }}">List View</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>