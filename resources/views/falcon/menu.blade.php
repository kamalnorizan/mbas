<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>

    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line"></span>
                </span>
            </button>

        </div><a class="navbar-brand" href="/">
            <div class="d-flex align-items-center py-3">
                <img class="me-2" src="{{ asset('/falcon/assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" />
                <span class="font-sans-serif">MBAS</span>
            </div>
        </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Menu</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>

                    <a class="nav-link {{ Route::is('dashboard') ? 'active':''}}" href="{{route('dashboard')}}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-line"></span>
                            </span>
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>

                    <a class="nav-link {{ Route::is('posts.index') ? 'active':''}}" href="{{route('posts.index')}}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-list"></span>
                            </span>
                            <span class="nav-link-text ps-1">Post List</span>
                        </div>
                    </a>

                    <a class="nav-link {{ Route::is('posts.create') ? 'active':''}}" href="{{route('posts.create')}}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-plus"></span>
                            </span>
                            <span class="nav-link-text ps-1">New Post</span>
                        </div>
                    </a>
                    @role('admin')
                    <a class="nav-link {{ Route::is('users.index') ? 'active':''}}" href="{{route('users.index')}}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-users"></span>
                            </span>
                            <span class="nav-link-text ps-1">User Management</span>
                        </div>
                    </a>
                    <a class="nav-link {{ Route::is('audittrail.index') ? 'active':''}}" href="{{route('audittrail.index')}}" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-line"></span>
                            </span>
                            <span class="nav-link-text ps-1">Audit Trails</span>
                        </div>
                    </a>
                    @endrole
                </li>
            </ul>
        </div>
    </div>
</nav>
