
@push('css')
    <style>
        .btn-login{
            width: 100%;
            text-align: center;
            padding:  1rem 0;
            font-size: 1.5rem;
            margin:.8rem 0;
        }
        hr{
            color: #000;
        }
        .btn-login.btn-registrar{
            background: #DADADA;
            color: #192a56
        }
        #remember_me{
            width: 1.5rem;
            height: 1.5rem;
        }
    </style>

@endpush

<x-app-layout>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card> --}}
    <div class="content-login-form">
        <div class="login-form">
            <h3>Iniciar Sesión</h3>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-8">
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-3 w-full text-2xl" type="email" name="email"
                    placeholder="Correo Electrónico" :value="old('email')" required autofocus />

                    <x-input-error for="email" ></x-input-error>
                </div>

                <!-- Password -->
                <div class="mt-8 mb-8">
                    <x-label for="password" :value="__('Contraseña')" />

                    <x-input id="password" class=" block mt-3 w-full text-2xl"
                                    type="password"
                                    name="password"
                                    placeholder="Contraseña"
                                    required autocomplete="current-password" />

                    <x-input-error for="password" ></x-input-error>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-4 mb-3">
                    <label for="remember_me" class="flex-1 text-6xl inline-flex items-center">
                        <input id="remember_me" type="checkbox" class=" bg-gray-100 rounded border-gray-800 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-xl text-gray-600">{{ __('Recordarme') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="flex-1 underline text-xl text-center text-gray-600 hover:text-gray-900 my-3" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
                <div class="flex flex-col">

                    <x-button class="btn-login">
                        {{ __('Entrar') }}
                    </x-button>
                    <hr/>
                    <label class="text-2xl text-center mt-4">No tienes una cuenta?
                        <a href="{{route('register')}}" class="underline text-2xl text-gray-600 hover:text-gray-900">Registrarse</a></label>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
