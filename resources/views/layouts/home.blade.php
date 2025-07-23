@extends('layouts.app')

@section('title', 'Kuliner - Temukan Rekomendasi Kuliner Terbaik')

@section('content')
    <!-- Hero Section with Animation -->
    <section class="bg-gradient-to-r from-orange-600 to-orange-400 text-white py-16 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center min-h-[80vh]">
                <div class="md:w-[45%] mb-8 md:mb-0 pl-0 md:pl-10 animate-fade-in-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Temukan Kuliner Terbaik di Kota Serang</h1>
                    <p class="text-xl mb-6 opacity-90">Jelajahi kekayaan kuliner nusantara dari Sabang sampai Merauke.
                        Temukan rekomendasi kuliner terbaik untuk semua selera.</p>
                    <div class="flex space-x-4">
                        {{-- <a href="#" class="px-6 py-3 bg-white text-orange-500 font-medium rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg">Jelajahi Sekarang</a> --}}
                        <a href="{{ route('food-places.index') }}"
                            class="px-6 py-3 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-orange-500 transition-all duration-300 transform hover:-translate-y-1">Lihat
                            Kategori</a>
                    </div>
                </div>
                <div class="md:w-[55%] animate-fade-in-right">
                    <img src="{{ asset('images/kotaserang.jpg') }}"
                        class="rounded-xl shadow-2xl w-full max-h-[900px] object-cover transform transition-all duration-500 hover:scale-105"
                        alt="Kuliner Kota Serang">
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section with Floating Animation -->
    <section class="py-8 bg-white relative z-10">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl p-6 -mt-20 relative z-20 animate-float-up">
                <form action="{{ route('food-places.index') }}" method="GET"
                    class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex-grow relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kuliner atau lokasi..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="md:w-1/4 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <select name="category"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent appearance-none transition-all duration-300">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full md:w-auto px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- 
    <!-- Search Results Section -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            @if (request()->has('search') || request()->has('category'))
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Hasil Pencarian</h2>
                    <p class="text-gray-600">
                        Ditemukan {{ $foodPlaces->total() }} hasil
                        @if (request('search'))
                            untuk "<span class="font-semibold">{{ request('search') }}</span>"
                        @endif
                        @if (request('category'))
                            @php
                                $selectedCategory = $categories->find(request('category'));
                            @endphp
                            @if ($selectedCategory)
                                dalam kategori "<span class="font-semibold">{{ $selectedCategory->name }}</span>"
                            @endif
                        @endif
                    </p>
                </div>
            @endif

            @if (isset($foodPlaces) && $foodPlaces->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($foodPlaces as $foodPlace)
                        <div
                            class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-2 animate-fade-in-up delay-100">
                            <div class="relative h-60 overflow-hidden">
                                @if ($foodPlace->images->count() > 0)
                                    <img src="{{ asset('storage/' . $foodPlace->images->first()->image_path) }}"
                                        alt="{{ $foodPlace->title }}"
                                        class="w-full aspect-video object-cover rounded-t-lg">
                                @else
                                    <div
                                        class="aspect-video w-full bg-gray-200 flex items-center justify-center rounded-t-lg">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute top-3 right-3 bg-white/90 text-yellow-600 rounded-full px-3 py-1 flex items-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-sm ml-1">
                                        {{ $foodPlace->reviews->count() > 0 ? number_format($foodPlace->reviews->avg('rating'), 1) : '0.0' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex items-center mb-3">
                                    <span class="bg-orange-100 text-orange-500 text-xs font-medium px-3 py-1 rounded-full">
                                        {{ $foodPlace->category ? $foodPlace->category->name : '-' }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $foodPlace->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $foodPlace->description }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-orange-500 font-medium">Rp
                                        {{ number_format($foodPlace->min_price, 0, '', '.') }} -
                                        {{ number_format($foodPlace->max_price, 0, '', '.') }}
                                    </span>
                                    <a href="{{ route('food-place.show', $foodPlace->id) }}"
                                        class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-all duration-300 opacity-0 group-hover:opacity-100">
                                        Detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $foodPlaces->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada hasil ditemukan</h3>
                    <p class="text-gray-500">Coba ubah kata kunci pencarian atau kategori yang dipilih</p>
                </div>
            @endif
        </div>
    </section> --}}

    <!-- Featured Categories Section with Hover Effects -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Kategori Kuliner</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi berbagai kategori kuliner di kota serang yang
                    menawarkan
                    cita rasa autentik.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($categories as $category)
                    <div
                        class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl animate-fade-in-up delay-100">
                        <div class="p-6 text-center">
                            <div
                                class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                @switch($category->name)
                                    @case('Restoran')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    @break

                                    @case('Kedai Kopi')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.5 1.5 0 013 15.546V12a9 9 0 018.657-8.993A9 9 0 0121 12v3.546z" />
                                        </svg>
                                    @break

                                    @case('Kedai Makanan')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                        </svg>
                                    @break

                                    @case('Warung Makan')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v2zm0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7v3a1 1 0 001 1h8a1 1 0 001-1V7M5 12h14" />
                                        </svg>
                                    @break

                                    @case('Cafe')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 14v3a2 2 0 002 2h4a2 2 0 002-2v-3M8 14l4-7 4 7M8 14H6a2 2 0 01-2-2V9a2 2 0 012-2h12a2 2 0 012 2v3a2 2 0 01-2 2h-2" />
                                        </svg>
                                    @break

                                    @case('Fast Food')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @break

                                    @case('Street Food')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                    @break

                                    @default
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                @endswitch
                            </div>

                            <!-- Category Title -->
                            <h3
                                class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors duration-300">
                                {{ $category->name }}
                            </h3>

                            <!-- Food Places Count -->
                            <p class="text-sm text-gray-500 mb-4">
                                {{ $category->food_places_count ?? 0 }} tempat
                                {{-- Debug: {{ $category->id }} - {{ $category->name }} --}}
                            </p>

                            <!-- Hover Action -->
                            <div
                                class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                <a href="{{ route('food-places.index', ['category' => $category->id]) }}"
                                    class="inline-flex items-center text-orange-500 text-sm font-medium hover:text-orange-600 transition-colors duration-200">
                                    Lihat Semua
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>

    <!-- Popular Restaurants Section with Staggered Animation -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8 animate-fade-in">
                <h2 class="text-3xl font-bold text-gray-800">Rekomendasi Terbaru</h2>
                <a href="{{ route('food-places.index') }}"
                    class="text-orange-500 hover:text-orange-600 font-medium flex items-center transition-all duration-300 transform hover:translate-x-1">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($foodPlaces->count() > 0)
                    @foreach ($foodPlaces as $foodPlace)
                        <div
                            class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-2 animate-fade-in-up delay-100">
                            <div class="relative h-60 overflow-hidden">
                                @if ($foodPlace->images->count() > 0)
                                    <img src="{{ asset('storage/' . $foodPlace->images->first()->image_path) }}"
                                        alt="{{ $foodPlace->title }}"
                                        class="w-full aspect-video object-cover rounded-t-lg">
                                @else
                                    <div
                                        class="aspect-video w-full bg-gray-200 flex items-center justify-center rounded-t-lg">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute top-3 right-3 bg-white/90 text-yellow-600 rounded-full px-3 py-1 flex items-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-sm ml-1">
                                        {{ $foodPlace->reviews->count() > 0 ? number_format($foodPlace->reviews->avg('rating'), 1) : '0.0' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex items-center mb-3">
                                    <span class="bg-orange-100 text-orange-500 text-xs font-medium px-3 py-1 rounded-full">
                                        {{ $foodPlace->category ? $foodPlace->category->name : '-' }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $foodPlace->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $foodPlace->description }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-orange-500 font-medium">Rp
                                        {{ number_format($foodPlace->min_price, 0, '', '.') }} -
                                        {{ number_format($foodPlace->max_price, 0, '', '.') }}
                                    </span>
                                    <a href="{{ route('food-place.show', $foodPlace->id) }}"
                                        class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-all duration-300 opacity-0 group-hover:opacity-100">
                                        Detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @if (isset($featuredPlaces) && $featuredPlaces->count() > 0)
                            @foreach ($featuredPlaces as $foodPlace)
                                <div
                                    class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-2 animate-fade-in-up delay-100">
                                    <div class="relative h-60 overflow-hidden">
                                        @if ($foodPlace->images->count() > 0)
                                            <img src="{{ asset('storage/' . $foodPlace->images->first()->image_path) }}"
                                                alt="{{ $foodPlace->title }}"
                                                class="w-full aspect-video object-cover rounded-t-lg">
                                        @else
                                            <div
                                                class="aspect-video w-full bg-gray-200 flex items-center justify-center rounded-t-lg">
                                                <span class="text-gray-500">No Image</span>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute top-3 right-3 bg-white/90 text-yellow-600 rounded-full px-3 py-1 flex items-center shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="text-sm ml-1">
                                                {{ $foodPlace->reviews->count() > 0 ? number_format($foodPlace->reviews->avg('rating'), 1) : '0.0' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="flex items-center mb-3">
                                            <span
                                                class="bg-orange-100 text-orange-500 text-xs font-medium px-3 py-1 rounded-full">
                                                {{ $foodPlace->category ? $foodPlace->category->name : '-' }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $foodPlace->title }}</h3>
                                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $foodPlace->description }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-orange-500 font-medium">Rp
                                                {{ number_format($foodPlace->min_price, 0, '', '.') }} -
                                                {{ number_format($foodPlace->max_price, 0, '', '.') }}
                                            </span>
                                            <a href="{{ route('food-place.show', $foodPlace->id) }}"
                                                class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-all duration-300 opacity-0 group-hover:opacity-100">
                                                Detail →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-full flex flex-col items-center justify-center gap-4 py-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <p class="text-gray-500">Tidak ada rekomendasi terbaru saat ini.</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Custom Animation Styles -->
    <style>
        .animate-fade-in-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-float-up {
            animation: floatUp 0.8s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes floatUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
