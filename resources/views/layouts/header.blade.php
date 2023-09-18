<!-- Start Top Nav -->
<nav class="container-fluid">
    <div class="row bg-dark">

        <div class="col-12 d-flex justify-content-between">

            <div>
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
            </div>
            <div>
                <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
            </div>

        </div>

    </div>
</nav>
<!-- Close Top Nav -->


<!-- Header -->
<nav class="container">

    <div class="row header d-flex align-items-center" id="header">

        <div class="col-lg-3" id="logo">

            <a class="logo" href=" {{ route('home') }} ">
                MaxShop
            </a>

        </div>
        <div class="col-lg-9 menu" id="user-menu">

            <ul class="menu-items w-100 d-flex align-items-center justify-content-between">
                <li class="menu-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="menu-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="menu-item">
                    <a class="nav-link" href="shop.html">Shop</a>
                </li>
                <li class="menu-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
            </ul>
        </div>


    </div>

    <div class="row">

        <div class="col-12 d-flex justify-content-between align-items-center" id="main-subheader">

            <div class="search d-flex" id="search">
                <form class="search-form d-flex w-100" method="get" action="{{ route('search') }}">
                    <input type="text" name="search" class="form-control @error('search') is-invalid @enderror"
                           placeholder="Поиск ..." @if(array_key_exists('search', $get_params_mass)) value="{{ $get_params_mass['search'] }}" @endif required>
                    <button type="submit" class="input-group-text">
                        <i class="fa fa-fw fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="user-navbar d-flex" id="user-navbar">

                <a class="text-decoration-none" href="#">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                </a>

                @if (\Illuminate\Support\Facades\Auth::check())
                    <div class="welcome d-flex">
                        <p class="mr-3 mb-0">| Добро пожаловать, {{ $user->name }}</p>
                    </div>
                    <a class="text-decoration-none" href="{{ route('logout') }}">
                        <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
                    </a>
                @else
                    <a class="text-decoration-none open-log-form">
                        <i class="fa fa-fw fa-sign-in-alt text-dark"></i>
                    </a>

                    <a class="text-decoration-none open-reg-form">
                        <i class="fa fa-fw fa-registered text-dark mr-3"></i>
                    </a>

                @endif
            </div>

        </div>

    </div>
    @error('search')
        <div class="row">
            <div class="validation-message">{{ $message }}</div>
        </div>
    @enderror

</nav>







