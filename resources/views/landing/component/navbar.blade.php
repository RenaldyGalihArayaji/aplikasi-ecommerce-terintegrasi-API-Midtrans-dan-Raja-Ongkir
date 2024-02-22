<nav class="site-nav mb-5">
    <div class="sticky-nav js-sticky-header">

        <div class="container position-relative">
            <div class="site-navigation text-center dark">
                <a href="{{ route('home')}}" class="logo menu-absolute m-0">Toko Malhest<span class="text-primary">.</span></a>

                <ul class="js-clone-nav pl-0 d-none d-lg-inline-block site-menu">
                    <li class="{{ Request::path() == '/' ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="{{ Request::path() == 'shop' ? 'active' : '' }}">
                        <a href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="has-children">
                        <a href="#">Pages</a>
                        <ul class="dropdown">
                            @auth
                                @if(\App\Models\Order::count() > 0)
                                    <li class="{{ Request::path() == 'info-order' ? 'active' : '' }}">
                                        <a href="{{ route('info_order') }}">My Orders</a>
                                    </li>
                                @endif
                            @endauth
                            <li class="{{ Request::path() == 'about' ? 'active' : '' }}">
                                <a href="{{ route('about') }}">About Shop</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                

                <div class="menu-icons">

                    @if (Auth::user())

                        <a href="{{ route('profilUser')}}" class="user-profile" >
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            </svg>
                        </a>

                        <a href="{{ route('cart.index')}}" class="cart" style="margin-right: 20px">
                            <span class="item-in-cart">{{ \App\Models\Cart::where('user_id', Auth::user()->id)->count()}}</span>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                        </a>
                        <form action="{{ route('logout')}}" method="post" class="d-inline">
                        @csrf
                        <button class="btn-auth btn btn-outline-dark btn-sm " type="submit" style="margin-left: 15px"><b>Logout</b></button>
                        </form>
                    @else
                         <a href="{{ route('login')}}" class="btn btn-outline-dark btn-sm" style="margin-right: 50px"><b>Login</b></a>
                    @endif

                </div>

                <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>

            </div>
        </div>
    </div>
</nav>