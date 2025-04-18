<nav class="bg-white shadow-lg z-50 fixed w-full top-0 left-0">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500 group-hover:text-orange-600 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800 ml-3 group-hover:text-orange-500 transition duration-300">Kuliner Nusantara</span>
                </a>
            </div>

            <!-- Primary Navbar items -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-300">Beranda</a>
                <a href="/food-places" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-300">Kategori</a>
                <a href="#" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-300">Rekomendasi</a>
                <a href="#" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition duration-300">Tentang Kami</a>
            </div>

            <!-- Secondary Navbar items -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <!-- Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 font-medium text-gray-700 hover:bg-orange-600 transition duration-300 bg-orange-500 text-white px-4 py-2 rounded-md">
                            <span>{{ Auth::user()->name }}</span>
                            <svg :class="{ 'rotate-180': open }" class="h-5 w-5 transform transition duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-50 border border-gray-100"
                        >
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-orange-500 transition duration-300">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil
                                </div>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-orange-500 transition duration-300">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 border border-gray-200 rounded-md hover:bg-gray-50 hover:text-orange-500 transition duration-300">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition duration-300">Daftar</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 hover:text-orange-500 transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-4 py-3 space-y-1 bg-white border-t border-gray-100">
            <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">Beranda</a>
            <a href="/food-places" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">Kategori</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">Rekomendasi</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">Tentang Kami</a>

            @auth
                <div class="pt-2 mt-2 border-t border-gray-100">
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-2 mt-2 border-t border-gray-100 space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition duration-300">Masuk</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-white bg-orange-500 hover:bg-orange-600 rounded-md transition duration-300">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Grab HTML Elements
    const btn = document.querySelector(".mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    // Add Event Listeners
    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>
