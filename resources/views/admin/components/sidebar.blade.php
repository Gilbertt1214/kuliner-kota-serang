<aside class="fixed inset-y-0 left-0 z-30 w-64 h-full bg-white shadow-md border-r border-gray-100">
    <!-- Header -->
    <div class="flex items-center justify-center h-16 px-6 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-indigo-600">SANTARA</a>
    </div>

    <!-- Menu -->
    <nav class="px-4 py-6">
        <ul class="space-y-2 text-sm font-medium">
            @php
                $menuItems = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'home'],
                    ['label' => 'Tempat Kuliner', 'route' => 'admin.food-places.index', 'icon' => 'building'],
                    ['label' => 'Kategori', 'route' => 'admin.categories.index', 'icon' => 'menu'],
                    ['label' => 'Users', 'route' => 'admin.users.index', 'icon' => 'users'],
                ];
            @endphp

            @foreach($menuItems as $item)
                <li>
                    {{-- <a href="{{ route($item['route']) }}" --}}
                        class="flex items-center px-4 py-3 rounded-lg transition
                            {{ request()->routeIs($item['route']) || request()->routeIs(str_replace('.index', '.*', $item['route']))
                                ? 'bg-indigo-50 text-indigo-600'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if ($item['icon'] == 'home')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2 7-7 7 7 2 2v10a1 1 0 01-1 1h-3m-10 0H4a1 1 0 01-1-1V12z" />
                            @elseif ($item['icon'] == 'building')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M9 3h6a2 2 0 012 2v14H7V5a2 2 0 012-2z" />
                            @elseif ($item['icon'] == 'menu')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            @elseif ($item['icon'] == 'users')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-1a4 4 0 00-4-4h-1m-4 5H3v-1a4 4 0 014-4h1m3-6a4 4 0 100-8 4 4 0 000 8zm6 4a4 4 0 100-8 4 4 0 000 8z" />
                            @endif
                        </svg>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach

            <!-- Logout -->
            <li class="pt-4 mt-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin ingin logout?')"
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
</aside>
