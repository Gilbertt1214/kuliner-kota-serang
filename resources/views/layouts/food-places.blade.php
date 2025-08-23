{{-- resources/views/foodplace/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-orange-50 pt-20 lg:pt-24 content-wrapper">
    <!-- Header Section -->
    <div class="container px-4 py-8 mx-auto">
        {{-- Enhanced Search and Filter Section --}}
        <div class="max-w-6xl mx-auto -mt-6 md:-mt-8 relative z-10 mb-12 px-4 search-section">
            <div class="bg-white shadow-2xl rounded-2xl p-6 md:p-8 border border-gray-100">
                <form action="{{ route('food-places.index') }}" method="GET" class="space-y-6">
                    <!-- Search Bar -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama tempat, menu, atau lokasi kuliner..."
                            class="block w-full pl-12 pr-4 py-4 text-lg border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 hover:shadow-md">
                    </div>

                    <!-- Filters Row -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Category Filter -->
                        <div class="relative">
                            <select name="category" class="w-full py-3 px-4 border border-gray-300 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 bg-white">
                                <option value="">🏪 Semua Kategori</option>
                                @if(isset($categories))
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="relative">
                            <select name="price_range" class="w-full py-3 px-4 border border-gray-300 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 bg-white">
                                <option value="">💰 Semua Harga</option>
                                <option value="0-50000" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>Di bawah 50rb</option>
                                <option value="50000-100000" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>50rb - 100rb</option>
                                <option value="100000-200000" {{ request('price_range') == '100000-200000' ? 'selected' : '' }}>100rb - 200rb</option>
                                <option value="200000-999999999" {{ request('price_range') == '200000-999999999' ? 'selected' : '' }}>Di atas 200rb</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div class="relative">
                            <select name="rating" class="w-full py-3 px-4 border border-gray-300 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 bg-white">
                                <option value="">⭐ Semua Rating</option>
                                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4+ Bintang</option>
                                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3+ Bintang</option>
                                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2+ Bintang</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <button type="submit" class="flex items-center justify-center px-6 py-3 font-semibold text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="hidden sm:inline">Cari Kuliner</span>
                            <span class="sm:hidden">Cari</span>
                        </button>
                    </div>

                    <!-- Clear Filters -->
                    @if (request()->hasAny(['search', 'category', 'price_range', 'rating']))
                        <div class="flex justify-end">
                            <a href="{{ route('food-places.index') }}"
                               class="inline-flex items-center px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Hapus Filter
                            </a>
                        </div>
                    @endif
                </form>

                {{-- Enhanced Search Results Info --}}
                @if (request()->has('search') || request()->has('category') || request()->has('price_range') || request()->has('rating'))
                    <div class="pt-6 mt-6 border-t border-gray-200">
                        <div class="flex flex-wrap items-center gap-4">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-semibold">{{ $foodPlaces->total() }} tempat ditemukan</span>
                            </div>

                            @if (request('search'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    🔍 "{{ request('search') }}"
                                </span>
                            @endif

                            @if (request('category'))
                                @php
                                    $selectedCategory = $categories->find(request('category'));
                                @endphp
                                @if ($selectedCategory)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-orange-100 text-orange-800">
                                        🏪 {{ $selectedCategory->name }}
                                    </span>
                                @endif
                            @endif

                            @if (request('price_range'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                    💰 {{ str_replace('-', ' - ', request('price_range')) }}
                                </span>
                            @endif

                            @if (request('rating'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                                    ⭐ {{ request('rating') }}+ Bintang
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Enhanced Grid Cards --}}
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($foodPlaces as $index => $place)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100 animate-fade-in-up"
                     style="animation-delay: {{ ($index % 8) * 0.1 }}s;">

                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-48">
                        @if($place->images->count() > 0)
                            <img src="{{ $place->images->first()->image_url }}"
                                 alt="{{ $place->title }}"
                                 class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-200 to-gray-300">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-500 text-sm">No Image</span>
                                </div>
                            </div>
                        @endif

                        <!-- Rating Badge -->
                        @php
                            $avgRating = $place->reviews->avg('rating') ?? 0;
                            $reviewCount = $place->reviews->count();
                        @endphp

                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 shadow-lg">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">{{ number_format($avgRating, 1) }}</span>
                            </div>
                        </div>

                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 text-xs font-semibold text-orange-600 bg-orange-100 rounded-full border border-orange-200">
                                {{ $place->category ? $place->category->name : 'Umum' }}
                            </span>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Quick Action Button -->
                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                            <a href="{{ route('food-place.show', $place->id) }}"
                               class="inline-flex items-center px-3 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium text-gray-700 hover:bg-white transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors duration-300 line-clamp-1">
                            {{ $place->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $place->description }}</p>

                        <!-- Location -->
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="line-clamp-1">{{ $place->location }}</span>
                        </div>

                        <!-- Reviews Info -->
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span>{{ $reviewCount }} ulasan</span>
                        </div>

                        <!-- Price & Action -->
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div>
                                <span class="text-lg font-bold text-orange-600">
                                    Rp {{ number_format($place->min_price, 0, '', '.') }}
                                </span>
                                @if($place->max_price > $place->min_price)
                                    <span class="text-gray-400 text-sm"> - {{ number_format($place->max_price, 0, '', '.') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('food-place.show', $place->id) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95">
                                Detail
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Enhanced Empty State -->
                <div class="col-span-full flex flex-col items-center justify-center py-16">
                    <div class="bg-gray-100 rounded-full p-8 mb-6">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-2">Tidak Ada Hasil Ditemukan</h3>
                    <p class="text-gray-500 text-center max-w-md mb-6">
                        Maaf, tidak ada tempat makan yang sesuai dengan kriteria pencarian Anda.
                        Coba ubah kata kunci atau filter yang digunakan.
                    </p>
                    <a href="{{ route('food-places.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset Pencarian
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Enhanced Pagination --}}
        @if(isset($foodPlaces) && method_exists($foodPlaces, 'links'))
            <div class="mt-12">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <!-- Results Info -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                        <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                            Menampilkan <span class="font-semibold">{{ $foodPlaces->firstItem() ?? 0 }}</span>
                            sampai <span class="font-semibold">{{ $foodPlaces->lastItem() ?? 0 }}</span>
                            dari <span class="font-semibold">{{ $foodPlaces->total() }}</span> hasil
                        </div>

                        <!-- Per Page Selector -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Tampilkan:</span>
                            <select onchange="changePerPage(this.value)"
                                    class="px-3 py-1 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="12" {{ request('per_page', 12) == 12 ? 'selected' : '' }}>12</option>
                                <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>
                                <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pagination Links -->
                    <div class="flex justify-center">
                        <nav class="relative z-0 inline-flex rounded-lg shadow-sm -space-x-px" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($foodPlaces->onFirstPage())
                                <span class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-1 hidden sm:inline">Previous</span>
                                </span>
                            @else
                                <a href="{{ $foodPlaces->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                                   class="relative inline-flex items-center px-3 py-2 rounded-l-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-1 hidden sm:inline">Previous</span>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @php
                                $start = max($foodPlaces->currentPage() - 2, 1);
                                $end = min($start + 4, $foodPlaces->lastPage());
                                $start = max($end - 4, 1);
                            @endphp

                            @if($start > 1)
                                <a href="{{ $foodPlaces->url(1) }}&{{ http_build_query(request()->except('page')) }}"
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    1
                                </a>
                                @if($start > 2)
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                        ...
                                    </span>
                                @endif
                            @endif

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $foodPlaces->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-orange-500 bg-orange-500 text-sm font-medium text-white">
                                        {{ $i }}
                                    </span>
                                @else
                                    <a href="{{ $foodPlaces->url($i) }}&{{ http_build_query(request()->except('page')) }}"
                                       class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        {{ $i }}
                                    </a>
                                @endif
                            @endfor

                            @if($end < $foodPlaces->lastPage())
                                @if($end < $foodPlaces->lastPage() - 1)
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                        ...
                                    </span>
                                @endif
                                <a href="{{ $foodPlaces->url($foodPlaces->lastPage()) }}&{{ http_build_query(request()->except('page')) }}"
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    {{ $foodPlaces->lastPage() }}
                                </a>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($foodPlaces->hasMorePages())
                                <a href="{{ $foodPlaces->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                                   class="relative inline-flex items-center px-3 py-2 rounded-r-lg border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <span class="mr-1 hidden sm:inline">Next</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 000-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-3 py-2 rounded-r-lg border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <span class="mr-1 hidden sm:inline">Next</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 000-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>

                    <!-- Quick Jump -->
                    @if($foodPlaces->lastPage() > 10)
                        <div class="mt-6 flex justify-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">Lompat ke halaman:</span>
                                <input type="number"
                                       min="1"
                                       max="{{ $foodPlaces->lastPage() }}"
                                       value="{{ $foodPlaces->currentPage() }}"
                                       onchange="jumpToPage(this.value)"
                                       class="w-20 px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <span class="text-sm text-gray-600">dari {{ $foodPlaces->lastPage() }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Enhanced CSS Animations and Styles -->
<style>
    /* Ensure content is below fixed navbar */
    body {
        padding-top: 0;
    }

    .main-content {
        margin-top: 0;
    }

    /* Safe area for iOS devices */
    @supports (padding-top: env(safe-area-inset-top)) {
        .pt-20 {
            padding-top: calc(5rem + env(safe-area-inset-top));
        }

        .lg\:pt-24 {
            padding-top: calc(6rem + env(safe-area-inset-top));
        }
    }

    /* Ensure no content is hidden behind navbar */
    /* .content-wrapper {
        min-height: calc(100vh - 80px);
    }

    @media (min-width: 1024px) {
        .content-wrapper {
            min-height: calc(100vh - 96px);
        }
    } */

    /* Adjust for fixed navbar */
    @media (max-width: 768px) {
        .pt-20 {
            padding-top: 5rem; /* 80px for mobile */
        }

        /* Reduce negative margin on mobile */
        .-mt-6 {
            margin-top: -1.5rem;
        }
    }

    @media (min-width: 769px) and (max-width: 1023px) {
        .pt-20 {
            padding-top: 5rem; /* 80px for tablet */
        }

        .md\:-mt-8 {
            margin-top: -2rem;
        }
    }

    @media (min-width: 1024px) {
        .lg\:pt-24 {
            padding-top: 6rem; /* 96px for desktop */
        }

        .md\:-mt-8 {
            margin-top: -2rem;
        }
    }

    /* Ensure search section doesn't overlap navbar */
    .search-section {
        min-height: 200px;
        z-index: 40;
    }

    /* Navbar should have higher z-index */
    nav {
        z-index: 50;
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
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

    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #fb923c;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #ea580c;
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    /* Loading state for images */
    img {
        transition: opacity 0.3s ease;
    }

    img[src=""] {
        opacity: 0;
    }

    /* Focus styles for accessibility */

    /* Hover effects for cards */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:opacity-100 {
        opacity: 1;
    }

    .group:hover .group-hover\:translate-y-0 {
        transform: translateY(0);
    }

    /* Custom gradient backgrounds */
    .bg-gradient-to-br {
        background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
    }

    /* Enhanced shadow for cards */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Backdrop blur support */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }

    /* Smooth hover transitions for buttons */
    button, a {
        position: relative;
        overflow: hidden;
    }

    button:before, a:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transition: width 0.6s, height 0.6s, top 0.6s, left 0.6s;
        transform: translate(-50%, -50%);
    }

    button:hover:before, a:hover:before {
        width: 300px;
        height: 300px;
        top: 50%;
        left: 50%;
    }

    /* Spin animation for loading */
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    /* Pulse animation */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Responsive grid improvements */
    @media (max-width: 640px) {
        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
    }

    @media (min-width: 640px) and (max-width: 1024px) {
        .sm\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 1024px) and (max-width: 1280px) {
        .lg\:grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (min-width: 1280px) {
        .xl\:grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }
</style>

<!-- JavaScript for Enhanced Functionality -->
<script>
    // Function to change items per page
    function changePerPage(perPage) {
        const url = new URL(window.location);
        url.searchParams.set('per_page', perPage);
        url.searchParams.delete('page'); // Reset to first page
        window.location.href = url.toString();
    }

    // Function to jump to specific page
    function jumpToPage(page) {
        const url = new URL(window.location);
        url.searchParams.set('page', page);
        window.location.href = url.toString();
    }

    // Add loading state for form submissions

        adjustLayout();

        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalContent = submitBtn.innerHTML;
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mencari...
                    `;
                    submitBtn.disabled = true;

                    // Restore original state if form submission fails
                    setTimeout(() => {
                        submitBtn.innerHTML = originalContent;
                        submitBtn.disabled = false;
                    }, 10000);
                }
            });
        });

        // Add smooth scroll behavior
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add intersection observer for animation triggers
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        const animatedElements = document.querySelectorAll('.animate-fade-in-up');
        animatedElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Add lazy loading for images
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));

        // Add keyboard navigation for pagination
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                if (e.key === 'ArrowLeft') {
                    const prevLink = document.querySelector('a[rel="prev"]');
                    if (prevLink) {
                        e.preventDefault();
                        window.location.href = prevLink.href;
                    }
                } else if (e.key === 'ArrowRight') {
                    const nextLink = document.querySelector('a[rel="next"]');
                    if (nextLink) {
                        e.preventDefault();
                        window.location.href = nextLink.href;
                    }
                }
            }
        });

        // Add search input debounce for better UX
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);

                // Add visual feedback
                this.style.borderColor = '#f59e0b';

                searchTimeout = setTimeout(() => {
                    this.style.borderColor = '#d1d5db';
                }, 1000);
            });
        }

        // Add hover effects for better UX
        const cards = document.querySelectorAll('.group');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
                this.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
            });
        });

        // Add touch support for mobile devices
        if ('ontouchstart' in window) {
            const touchElements = document.querySelectorAll('.hover\\:scale-105');
            touchElements.forEach(element => {
                element.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(1.05)';
                });

                element.addEventListener('touchend', function() {
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });
        }
    });

    // Add search suggestions functionality
    function initSearchSuggestions() {
        const searchInput = document.querySelector('input[name="search"]');
        if (!searchInput) return;

        let timeout;
        let suggestionsContainer;

        // Create suggestions container
        function createSuggestionsContainer() {
            if (suggestionsContainer) return;

            suggestionsContainer = document.createElement('div');
            suggestionsContainer.className = 'absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg z-50 mt-1 max-h-60 overflow-y-auto';
            suggestionsContainer.style.display = 'none';
            searchInput.parentNode.appendChild(suggestionsContainer);
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = this.value.trim();

            if (query.length < 2) {
                if (suggestionsContainer) {
                    suggestionsContainer.style.display = 'none';
                }
                return;
            }

            timeout = setTimeout(() => {
                // Here you would typically make an API call to get suggestions
                // For now, we'll show a simple loading state
                createSuggestionsContainer();
                suggestionsContainer.innerHTML = `
                    <div class="p-3 text-sm text-gray-500 flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mencari saran...
                    </div>
                `;
                suggestionsContainer.style.display = 'block';
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (suggestionsContainer && !searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
    }

    // Initialize search suggestions when page loads
    document.addEventListener('DOMContentLoaded', initSearchSuggestions);
</script>
@endsection
