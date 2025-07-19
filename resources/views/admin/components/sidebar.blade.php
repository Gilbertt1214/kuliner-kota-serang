<aside class="fixed inset-y-0 left-0 z-30 w-64 h-full bg-white shadow-md border-r border-gray-100 transition-all duration-300 ease-in-out">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center h-16 px-6 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-indigo-600">SANTARA</span>
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="px-4 py-6">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors
                          {{ request()->routeIs('admin.dashboard') ?
                             'bg-indigo-50 text-indigo-600' :
                             'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>

            <!-- Food Places -->
            <li>
                <a href="{{ route('admin.food-places.index') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors
                          {{ request()->routeIs('admin.food-places.*') ?
                             'bg-indigo-50 text-indigo-600' :
                             'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Tempat kuliner
                </a>
            </li>

            <!-- Categories -->
            <li>
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors
                          {{ request()->routeIs('admin.categories.*') ?
                             'bg-indigo-50 text-indigo-600' :
                             'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Kategori
                </a>
            </li>

            <!-- Users -->
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors
                          {{ request()->routeIs('admin.users.*') ?
                             'bg-indigo-50 text-indigo-600' :
                             'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
            </li>

            <!-- Logout -->
            <li class="pt-4 mt-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" onclick="confirmLogout()"
                            class="flex items-center w-full px-4 py-3 text-sm font-medium text-left text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                document.querySelector('form[action="{{ route('logout') }}"]').submit();
            }
        }
    </script>
</aside>
