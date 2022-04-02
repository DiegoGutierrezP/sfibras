{{-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')">
                             {{ __('Perfil') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-dropdown-link :href="route('profile')">
                    {{ __('Perfil') }}
               </x-dropdown-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Salir') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> --}}

<header class="header">
    <a href="{{route('home')}}" class="logo">
        <img src="{{Storage::url('cliente/sfibraslogo.png')}}" alt="">
    </a>
    <nav class="navbar">
        <a href="{{route('home')}}" class="@if(request()->routeIs('home'))  active-navbar-link @endif">Inicio</a>
        <a href="{{route('nosotros')}}" class="@if(request()->routeIs('nosotros'))  active-navbar-link @endif">Nosotros</a>
        <a href="{{route('servicios')}}" class="@if(request()->routeIs('servicios'))  active-navbar-link @endif">Servicios</a>
        <a href="">Trabajos</a>
        <a href="{{route('contacto')}}" class="@if(request()->routeIs('contacto'))  active-navbar-link @endif">Contacto</a>
    </nav>
    <div class="icons">
        <div id="menu-btn" class="btn fas fa-bars"></div>
        <div id="info-btn" class="btn fa-solid fa-circle-info"></div>
        <div id="search-btn" class="btn fas fa-search"></div>

        @auth
        <div class="profile-content">
            <div id="auth-btn" class="btn fas fa-user" ></div>
            <div class="menu-profile">
                {{-- <h3>{{ __('Manage Account') }}<br> <span>{{ Auth::user()->name }}</span></h3> --}}
                <ul>
                    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li><a href="{{ route('profile') }}">Perfil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Salir
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @else
        <a href="{{route('login')}}" ><div id="login-btn" class="btn fas fa-user @if(request()->routeIs('login'))  header-icons-active @endif" ></div></a>
        @endauth

    </div>
    <form action="" class="search-form">
        <input type="search" name="" placeholder="Busque aqui.." id="search-form">
        <label for="search-box" class="fas fa-search"></label>
    </form>

</header>
<div class="contact-info-content">
    <div class="contact-info">
    <div id="close-contact-info" class="fas fa-times"></div>
    <div class="info">
       <i class="fas fa-phone"></i>
        <h3>Teléfono</h3>
        <p>+51 956871799</p>
        <p>+51 956871799</p>
    </div>
    <div class="info">
        <i class="fas fa-envelope"></i>
         <h3>Correo</h3>
         <p>sfibras@gmail.com</p>
         <p>sfibras32@gmail.com</p>
     </div>
     <div class="info">
        <i class="fas fa-map-marker-alt"></i>
         <h3>Oficina</h3>
         <p>av las flores 22 , San juan de Lurigancho</p>
     </div>
     <div class="share">
         <a href="" class="fab fa-facebook-f"></a>
         <a href="" class="fab fa-twitter"></a>
         <a href="" class="fab fa-instagram"></a>
     </div>
</div>
</div>


