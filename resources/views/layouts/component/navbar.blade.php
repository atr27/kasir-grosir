<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    @if (auth()->user()->level == 1)
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="fas fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('user-management').submit();"
                        class="dropdown-item">
                        <i class="fas fa-user-cog"></i>
                        User
                    </a>
                    <div class="dropdown-divider">
                    </div>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('pengaturan').submit();"
                        class="dropdown-item">
                        <i class="fas fa-tools"></i>
                        Pengaturan
                    </a>

                    <div class="dropdown-divider">
                    </div>
                    <a href="#" class="dropdown-item bg-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Keluar
                    </a>
            </div>
        </li>
    </ul>
    @endif
</nav>

<form action="{{ route('logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
<form action="{{ route('user.index') }}" method="get" class="d-none" id="user-management"></form>
<form action="{{ route('pengaturan.index') }}" method="get" class="d-none"id="pengaturan"></form>
