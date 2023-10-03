<nav class="topnav">
    <a class="navbar-brand" href="/"><?=$_ENV['APP_NAME']?></a> 
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <div class="d-flex justify-content-around">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">My Projects</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Task Setting
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/task/types">
                        Type</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="">Priority Level</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">
                        Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </li>
        </div>
    </ul>
</nav>