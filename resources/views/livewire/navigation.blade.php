<div>
    <header class="bg-blue-600 text-white py-4 lg:py-0">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
            <div class="text-center lg:text-left">

                <a href="{{ url('/') }}"><img src="{{ asset('logo.webp') }}" alt="" class="w-60 lg:w-40"></a>

            </div>
            <div class="flex flex-col lg:flex-row items-center lg:w-auto w-full gap-2 justify-end mt-4 lg:mt-0">

                @auth
                    <a href="{{ route('profile.show') }}" class="text-white mb-3 lg:mb-0 block w-80 lg:w-auto bg-blue-700 hover:bg-blue-800 py-2 px-4 rounded-md text-center font-bold">
                        {{ __('Profile') }}
                    </a>
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="text-white mb-3 lg:mb-0 block w-80 lg:w-auto bg-blue-700 hover:bg-blue-800 py-2 px-4 rounded-md text-center font-bold">
                            Admin
                        </a>
                    @endif
            
                    <form method="POST" action="{{ route('logout') }}" x-data class="w-full lg:w-auto">
                        @csrf
            
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();" style="margin: auto" class="text-white block w-80 lg:w-auto bg-red-600 hover:bg-red-700 py-2 px-4 rounded-md text-center font-bold">
                            Salir
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white mb-3 lg:mb-0 block w-80 lg:w-auto bg-blue-700 hover:bg-blue-800 py-2 px-4 rounded-md text-center font-bold">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="text-white block w-80 lg:w-auto bg-blue-700 hover:bg-blue-800 py-2 px-4 rounded-md text-center font-bold">
                        Regístrate
                    </a>
                @endauth
            
            </div>
            
        </div>
    </header>
</div>