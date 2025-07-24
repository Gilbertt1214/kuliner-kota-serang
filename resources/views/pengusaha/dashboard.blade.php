@extends('layouts.admin')

@section('content')
    @php
        use Illuminate\Support\Facades\Storage;
    @endphp
    <div class="">
        <!-- Enhanced Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Pengusaha</h1>
                <p class="text-gray-600 mt-2">
                    Kelola dan pantau bisnis kuliner Anda dengan mudah
                </p>
                <div class="flex items-center mt-3 text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Selamat datang, {{ Auth::user()->name }}</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right text-sm text-gray-500">
                    <p>Last updated</p>
                    <p class="font-medium">{{ now()->format('d M Y, H:i') }}</p>
                </div>
                <a href="{{ route('pengusaha.food-places.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Tempat Kuliner
                </a>
            </div>
        </div>

        <!-- Enhanced Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Places Card -->
            <div
                class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Tempat</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2 group-hover:text-indigo-600 transition-colors">
                                {{ $stats['total'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">Tempat kuliner terdaftar</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Places Card -->
            <div
                class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Aktif</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2 group-hover:text-green-600 transition-colors">
                                {{ $stats['active'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">Tempat yang beroperasi</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Places Card -->
            <div
                class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Menunggu Review</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2 group-hover:text-yellow-600 transition-colors">
                                {{ $stats['pending'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">Dalam proses verifikasi</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rejected Places Card -->
            <div
                class="bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Ditolak</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2 group-hover:text-red-600 transition-colors">
                                {{ $stats['rejected'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">Perlu perbaikan</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Alert Section -->
        @if ($stats['pending'] > 0)
            <div
                class="bg-gradient-to-r from-yellow-50 to-yellow-100 border-l-4 border-yellow-400 rounded-lg p-6 mb-8 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-semibold text-yellow-800">
                            {{ $stats['pending'] }} tempat kuliner menunggu persetujuan admin
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Admin akan mereview submission Anda dalam 1-3 hari kerja. Pastikan informasi yang Anda
                                berikan lengkap dan akurat.</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('pengusaha.food-places.index') }}"
                                class="inline-flex items-center px-3 py-2 border border-yellow-600 text-sm font-medium rounded-md text-yellow-800 bg-yellow-200 hover:bg-yellow-300 transition-colors">
                                Lihat Detail
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Food Places List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Tempat Kuliner Anda</h3>
                                <p class="text-sm text-gray-600">Kelola dan pantau status tempat kuliner</p>
                            </div>
                            <a href="{{ route('pengusaha.food-places.index') }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                Lihat Semua
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    @if ($recentFoodPlaces->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach ($recentFoodPlaces as $place)
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-start space-x-4">
                                            <!-- Place Image -->
                                            <div class="flex-shrink-0">
                                                @php
                                                    $primaryImage = $place->images->where('type', 'business')->first();
                                                @endphp
                                                @if ($primaryImage)
                                                    <img class="h-16 w-16 rounded-lg object-cover border border-gray-200"
                                                        src="{{ Storage::url($primaryImage->image_path) }}"
                                                        alt="{{ $place->name }}">
                                                @else
                                                    <div
                                                        class="h-16 w-16 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                                        <svg class="h-8 w-8 text-gray-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Place Info -->
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-lg font-semibold text-gray-900 truncate">
                                                    {{ $place->title }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $place->category->name ?? 'Kategori tidak diketahui' }}</p>
                                                <div class="flex items-center mt-2 space-x-4">
                                                    <span class="text-sm text-gray-500">
                                                        <svg class="inline w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                        </svg>
                                                        {{ Str::limit($place->location, 30) }}
                                                    </span>
                                                    <span class="text-sm text-gray-500">
                                                        <svg class="inline w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                            </path>
                                                        </svg>
                                                        {{ $place->reviews->count() }} ulasan
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status & Actions -->
                                        <div class="flex items-center space-x-3">
                                            <!-- Status Badge -->
                                            @switch($place->status)
                                                @case('active')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></div>
                                                        Aktif
                                                    </span>
                                                @break

                                                @case('pending')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <div class="w-1.5 h-1.5 bg-yellow-400 rounded-full mr-1.5"></div>
                                                        Pending
                                                    </span>
                                                @break

                                                @case('rejected')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <div class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1.5"></div>
                                                        Ditolak
                                                    </span>
                                                @break

                                                @default
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                                        {{ $place->status }}
                                                    </span>
                                            @endswitch

                                            <!-- Action Buttons -->
                                            <div class="flex space-x-1">
                                                <a href="{{ route('pengusaha.food-places.show', $place->id) }}"
                                                    class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors"
                                                    title="Lihat Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('pengusaha.food-places.edit', $place->id) }}"
                                                    class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors"
                                                    title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Tempat Kuliner</h3>
                                <p class="text-gray-500 mb-6">Mulai dengan mendaftarkan tempat kuliner pertama Anda</p>
                                <a href="{{ route('pengusaha.food-places.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Daftarkan Tempat Kuliner
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <!-- Sidebar - Quick Actions & Business Insights -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Business Insights -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Business Insights</h3>
                        <p class="text-sm text-gray-600">Informasi bisnis Anda</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Total Reviews -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Total Ulasan</span>
                                </div>
                                <span class="text-lg font-bold text-gray-900">
                                    {{ $stats['total_reviews'] }}
                                </span>
                            </div>

                            <!-- Average Rating -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Rating Rata-rata</span>
                                </div>
                                <span class="text-lg font-bold text-gray-900">
                                    {{ $stats['average_rating'] }}/5
                                </span>
                            </div>

                            <!-- Tips Section -->
                            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-blue-900">Tips Bisnis</h4>
                                        <p class="text-xs text-blue-700 mt-1" data-tip>
                                            {{ collect([
                                                'Pastikan foto tempat kuliner berkualitas tinggi',
                                                'Update menu dan harga secara berkala',
                                                'Tanggapi ulasan pelanggan dengan baik',
                                                'Lengkapi informasi kontak dan jam operasional',
                                                'Promosikan keunikan tempat kuliner Anda',
                                            ])->random() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                        <p class="text-sm text-gray-600">Update terkini</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @if ($stats['total'] > 0)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">
                                            Anda memiliki <span class="font-medium">{{ $stats['total'] }} tempat
                                                kuliner</span> terdaftar
                                        </p>
                                        <p class="text-xs text-gray-500">{{ now()->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($stats['active'] > 0)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">
                                            <span class="font-medium">{{ $stats['active'] }} tempat aktif</span> dan
                                            beroperasi
                                        </p>
                                        <p class="text-xs text-gray-500">Status terkini</p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-2 h-2 bg-gray-400 rounded-full mt-2"></div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">
                                        Dashboard diperbaharui
                                    </p>
                                    <p class="text-xs text-gray-500">{{ now()->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    // Delete Modal Functionality
                    const deleteModal = document.getElementById('deleteModal');
                    const deleteForm = document.getElementById('deleteForm');
                    const deleteItemName = document.getElementById('deleteItemName');
                    const deleteButtons = document.querySelectorAll('.delete-btn');
                    const cancelDelete = document.getElementById('cancelDelete');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const itemId = this.getAttribute('data-id');
                            const itemName = this.getAttribute('data-name');
                            const actionUrl = this.getAttribute('data-action');

                            deleteItemName.textContent = itemName;
                            deleteForm.action = actionUrl;
                            deleteModal.classList.remove('hidden');
                        });
                    });

                    <
                    !--Enhanced Dashboard Scripts-- >
                    <
                    script >
                        document.addEventListener('DOMContentLoaded', function() {
                            // Animate stats cards on load
                            const statsCards = document.querySelectorAll('.grid .bg-white');
                            statsCards.forEach((card, index) => {
                                card.style.opacity = '0';
                                card.style.transform = 'translateY(20px)';
                                setTimeout(() => {
                                    card.style.transition = 'all 0.5s ease';
                                    card.style.opacity = '1';
                                    card.style.transform = 'translateY(0)';
                                }, index * 100);
                            });

                            // Random tips rotation  
                            const tips = [
                                'Pastikan foto tempat kuliner berkualitas tinggi dan menarik',
                                'Update menu dan harga secara berkala agar tetap akurat',
                                'Tanggapi ulasan pelanggan dengan sopan dan profesional',
                                'Lengkapi informasi kontak dan jam operasional dengan jelas',
                                'Promosikan keunikan dan keunggulan tempat kuliner Anda',
                                'Jaga kebersihan dan kualitas pelayanan untuk rating yang baik'
                            ];

                            const tipElement = document.querySelector('[data-tip]');
                            if (tipElement) {
                                setInterval(() => {
                                    const randomTip = tips[Math.floor(Math.random() * tips.length)];
                                    tipElement.style.opacity = '0';
                                    setTimeout(() => {
                                        tipElement.textContent = randomTip;
                                        tipElement.style.opacity = '1';
                                    }, 300);
                                }, 15000); // Change tip every 15 seconds
                            }

                            // Add loading states for action buttons
                            const actionButtons = document.querySelectorAll('a[href*="create"], a[href*="edit"]');
                            actionButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    this.style.opacity = '0.7';
                                    this.innerHTML = this.innerHTML.replace(/^/,
                                        '<svg class="animate-spin w-4 h-4 mr-2 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>'
                                    );
                                });
                            });

                            // Keyboard shortcuts
                            document.addEventListener('keydown', function(e) {
                                if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                                    e.preventDefault();
                                    window.location.href = '{{ route('pengusaha.food-places.create') }}';
                                }
                            });
                        });
    </script>
@endsection
