<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logo_tec.png') }}" alt="Logo" class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <!-- Mostrar según el rol -->
                    @if (in_array('admin', $user_roles) or in_array('CAD', $user_roles))
                        <div class="hidden space-x-2 sm:-my-px sm:ml-2 sm:flex">
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('Registrar Usuarios') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-2 sm:-my-px sm:ml-2 sm:flex">
                            <x-nav-link :href="route('departamentos.create')" :active="request()->routeIs('departamentos.create')">
                                {{ __('Registrar Departamento') }}
                            </x-nav-link>
                        </div>
                    @endif

                    @if (in_array('Jefe Departamento', $user_roles) or
                            in_array('Subdirector Academico', $user_roles) or
                            in_array('admin', $user_roles) or
                            in_array('CAD', $user_roles))
                        <div class="hidden space-x-2 sm:-my-px sm:ml-2 sm:flex">
                            <x-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')">
                                {{ __('Usuarios') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-2 sm:-my-px sm:ml-2 sm:flex">
                            <x-nav-link :href="route('departamentos.index')" :active="request()->routeIs('departamentos.index')">
                                {{ __('Departamentos') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-2 sm:-my-px sm:ml-2 sm:flex">
                            <x-nav-link :href="route('datos')" :active="request()->routeIs('datos')">
                                {{ __('Visualizar') }}
                            </x-nav-link>
                        </div>
                    @endif

                    @if ($tipo_usuario === 1)
                        <x-nav-link :href="route('formulario')" :active="request()->routeIs('formulario')">
                            {{ __('Registrar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mis_capacitaciones')" :active="request()->routeIs('mis_capacitaciones')">
                            {{ __('Mis capacitaciones') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->email }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>