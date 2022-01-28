<nav class="navbar fixed-top navbar-light" style="background-color: #F4D1AE; border-bottom: 2px outset;">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <div>
            <button class="navbar-toggler button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon" id="toggler-icon"></span>
            </button>    
            <a class="navbar-brand" href="{{ url ('/') }}">
                <img id="tlc_logo" src="{{ asset('/assets/tlc_logo.svg') }}" alt="TLC_TextLogo">
            </a>
        
            <!-- Adaptar para mudar os active links -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" data-bs-scroll="true" data-bs-backdrop="true">
                <div class="offcanvas-header" style="background-color: #F4D1AE">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between position-relative">
                    <div>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url ('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url ('/products') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url ('/about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url ('/faq') }}">FAQs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url ('/contact') }}">Contacts</a>
                        </li>
                        </ul>
                    </div>
                    <div class="position-absolute bottom-0 start-0" style="background-color: #F4D1AE; width: 100%;"> 
                        <p style="text-align: center"> Developed for LBAW @FEUP 21/22.
                        <br> @Copyright 2022 'The Last Chapter'. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <form method="post" action="{{ route('search')}}">
                @csrf
                <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="margin-top:1.6em; margin-bottom: 0em; width: 50em; height: 3.5em; background-color: #F4EDEA;">
            </form>
        </div>

        <div>
            <form class="container-fluid justify-content-end" style="margin-top:0.3em; margin-bottom: 0em">
                
                @php $id = 0; @endphp
                
                @if (Auth::check())
                @php $id = Auth::user()->id; @endphp
                @endif

                @if (Auth::check() and $id != 1)
                <a class="button"  href="{{ url('/wishlist') }}"> Wishlist </a>
                @endif

                @if ($id != 1)
                <a class="button" href="{{ url('/cart') }}" > Cart </a>
                @endif

                @if (Auth::check())
                <a class="button" href="{{ url('/logout') }}"> Logout </a> <a class="button button-outline" style="font-weight: bold; margin-left: 1em;" href="<?php echo '/users/'.$id.''; ?>">{{ Auth::user()->username }}</a>
                @else
                <a class="button" href="{{ url('/login') }}"> Login </a>
                @endif
            </form>   
        </div>

    </div>
</nav>
