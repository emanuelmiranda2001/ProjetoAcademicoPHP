<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{asset(mix('js/app.js'))}}" defer></script>
	<script type="text/javascript">
	var siteUrl = "{{url('/')}}";
	  </script>
	<script defer src="{{ asset('js/auto.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset(mix('css/app.css'))}}" rel="stylesheet">
	 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('shops') }}">
                    {{ __('MyStore') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ">
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('shops') }}">{{ __('Shop') }}</a>
                        </li>
                    </ul>
					<ul class="navbar-nav ">
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('product.shoppingCart') }}">
							{{ __('Cart') }}
							<span class="badge badge-secondary">{{ Session::has('cart') ? Session::get('cart') ->totalQty : '' }}
							</a>
                        </li>
                    </ul>
					<ul class="navbar-nav ">
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('search') }}">{{ __('Search') }}</a>
                        </li>
                    </ul>
					
					<ul class="navbar-nav ">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Tickets
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="{{ route('new_ticket') }}">{{ __('New Ticket') }}</a>
						  <a class="dropdown-item" href="{{ route('my_tickets') }}">{{ __('My Tickets') }}</a>
						</div>
					</li>
					</ul>
					
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									
									<a class="dropdown-item" href="{{ route('users.edit-profile') }}">
                                        {{ __('My Profile') }}
                                    </a>
									<a class="dropdown-item" href="{{ route('password.edit') }}">
                                        {{ __('Change Password') }}
                                    </a>
									<a class="dropdown-item" href="{{ route('user.profile') }}">
                                        {{ __('My Orders') }}
                                    </a>
									
									
									@role('admin')
									<div class="dropdown-divider"></div>
									<a 
										class="dropdown-item" href="{{ route('users.index') }}">{{ __('List Users') }}
									</a>
									<a 
										class="dropdown-item" href="{{ route('tickets') }}">{{ __('All Tickets') }}
									</a>
									<div class="dropdown-divider"></div>
									<a 
										class="dropdown-item" href="{{ route('products.index') }}">{{ __('Manage Products') }}
									</a>
									<a 
										class="dropdown-item" href="{{ route('products.create') }}">{{ __('Add Product') }}
									</a>
									<a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        {{ __('All Orders') }}
                                    </a>
									@endrole
									<div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>