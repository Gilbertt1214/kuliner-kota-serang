<nav class="bg-white shadow-lg z-50 fixed w-full top-0 left-0">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center py-4">
            <!-- Logo with animation -->
            <div class=" flex items-center">
                <a href="{{ route('home') }}" class=" flex items-center group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500 group-hover:text-orange-600 transition-all duration-300 transform group-hover:rotate-12" viewBox="0 0 24 24" fill="currentColor">
    <!-- Utensil Set Icon -->
    <path d="M8 1a2 2 0 0 1 2 2v2h4V3a2 2 0 1 1 4 0v2a3 3 0 0 1 3 3v1a3 3 0 0 1-3 3v7a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-7a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3V3a2 2 0 0 1 2-2z"/>
    <!-- Plate/Bowl -->
    <path d="M4 10a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1 1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z" fill="#fff"/>
    <!-- Food (noodles or garnish) -->
    <path d="M5 12h14v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1z" fill="#f59e0b" opacity="0.8"/>
</svg>
                    <span class="text-xl font-bold text-gray-800 ml-1 group-hover:text-orange-500 transition-all duration-300 transform group-hover:translate-x-1">Santara</span>
                </a>
            </div>

            <!-- Primary Navbar items with hover animations -->
            <div class="hidden md:flex items-center space-x-1 md:space-x-4">
                <a href="/" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition-all duration-300 hover:scale-105">Beranda</a>
                <a href="/food-places" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition-all duration-300 hover:scale-105">Kategori</a>
                <a href="#" class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-gray-50 rounded-md transition-all duration-300 hover:scale-105">Rekomendasi</a>

                <a href="/register-business" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-600 transition-all duration-300 transform hover:scale-105 hover:shadow-md">Daftar Usaha</a>
            </div>

            <!-- Secondary Navbar items -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <!-- Animated Dropdown with Alpine.js -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 font-medium transition-all duration-300 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md hover:shadow-md">
                            <span>{{ Auth::user()->name }}</span>
                            <svg :class="{ 'rotate-180': open }" class="h-5 w-5 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 transform scale-95 -translate-y-2"
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-50 border border-gray-100"
                        >
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-orange-500 transition-all duration-300 hover:pl-6">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil
                                </div>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-orange-500 transition-all duration-300 hover:pl-6">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 border border-gray-200 rounded-md hover:bg-gray-50 hover:text-orange-500 transition-all duration-300 hover:shadow-md hover:border-orange-300">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 hover:shadow-md">Daftar</a>
                @endauth
            </div>

            <!-- Animated Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button focus:outline-none transition-transform duration-300 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 hover:text-orange-500 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Animated Mobile menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-4 py-3 space-y-1 bg-white border-t border-gray-100">
            <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">Beranda</a>
            <a href="/food-places" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">Kategori</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">Rekomendasi</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">Tentang Kami</a>
            <a href="/register-business" class="block px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-md transition-all duration-300 hover:pl-6 hover:shadow-md">Daftar Usaha</a>

            @auth
                <div class="pt-2 mt-2 border-t border-gray-100">
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-2 mt-2 border-t border-gray-100 space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-orange-500 rounded-md transition-all duration-300 hover:pl-6">Masuk</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-white bg-orange-500 hover:bg-orange-600 rounded-md transition-all duration-300 hover:pl-6 hover:shadow-md">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Grab HTML Elements
    const btn = document.querySelector(".mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    // Add Event Listeners with animation
    btn.addEventListener("click", () => {
        // Toggle menu with animation
        if (menu.classList.contains("hidden")) {
            // Show menu with animation
            menu.classList.remove("hidden");
            menu.style.maxHeight = "0px";
            menu.style.opacity = "0";
            menu.style.overflow = "hidden";
            menu.style.transition = "max-height 0.5s ease, opacity 0.3s ease";

            // Force a reflow to ensure the transition works
            menu.offsetHeight;

            // Set the new height and opacity
            menu.style.maxHeight = menu.scrollHeight + "px";
            menu.style.opacity = "1";

            // Rotate the button icon
            btn.querySelector("svg").style.transform = "rotate(90deg)";
            btn.querySelector("svg").style.transition = "transform 0.3s ease";
        } else {
            // Hide menu with animation
            menu.style.maxHeight = "0px";
            menu.style.opacity = "0";

            // Reset the button icon
            btn.querySelector("svg").style.transform = "rotate(0deg)";

            // Add the hidden class after the animation
            setTimeout(() => {
                menu.classList.add("hidden");
                menu.style.maxHeight = "";
                menu.style.opacity = "";
                menu.style.overflow = "";
            }, 500);
        }
    });

    // Add smooth scroll for navigation links
    document.querySelectorAll('nav a[href^="/"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            // Add a click ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;

            ripple.style.cssText = `
                position: absolute;
                background: rgba(255, 255, 255, 0.7);
                border-radius: 50%;
                pointer-events: none;
                width: 100px;
                height: 100px;
                top: ${y - 50}px;
                left: ${x - 50}px;
                transform: scale(0);
                opacity: 1;
                animation: rippleEffect 0.6s linear;
            `;

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
</script>

<style>
    /* Add ripple effect animation */
    @keyframes rippleEffect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Add a global style for smoother transitions */
    * {
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    }

    /* Make the navbar links relative for the ripple effect */
    nav a {
        position: relative;
        overflow: hidden;
    }
</style>
