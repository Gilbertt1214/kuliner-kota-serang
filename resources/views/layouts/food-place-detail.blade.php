{{-- resources/views/foodPlace/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container px-4 py-8 pt-20 mx-auto">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section with Back Button - Enhanced Animation -->
            <div class="flex items-center mb-6">
                <a href="{{ route('food-places.index') }}"
                    class="flex items-center text-gray-600 transition-colors duration-300 hover:text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">Kembali ke Daftar</span>
                </a>
            </div>

            <!-- Main Content Card - Added Entrance Animation -->
            <div
                class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg rounded-xl hover:shadow-xl animate-fade-in-up">
                <!-- Hero Image Section - Enhanced Carousel with Navigation -->
                <div class="relative group">
                    @if ($foodPlace->businessImages->count())
                        <!-- Carousel Container -->
                        <div class="relative overflow-hidden">
                            <!-- Slides Container -->
                            <div id="image-carousel" class="flex transition-transform duration-500 ease-in-out">
                                @foreach ($foodPlace->businessImages as $img)
                                    <div class="flex-shrink-0 w-full">
                                        <div class="relative w-full h-96">
                                            <img src="{{ $img->image_url }}"
                                                alt="{{ $foodPlace->title }}"
                                                class="object-cover w-full h-full rounded-lg shadow" />
                                            <div
                                                class="absolute inset-0 rounded-lg bg-gradient-to-t from-black/30 to-transparent">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Navigation Arrows -->
                            <button id="prev-btn"
                                class="absolute p-2 text-orange-500 transition-all duration-300 -translate-y-1/2 rounded-full shadow-md opacity-0 left-4 top-1/2 bg-white/80 hover:bg-white group-hover:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button id="next-btn"
                                class="absolute p-2 text-orange-500 transition-all duration-300 -translate-y-1/2 rounded-full shadow-md opacity-0 right-4 top-1/2 bg-white/80 hover:bg-white group-hover:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Indicators -->
                            <div class="absolute flex space-x-2 -translate-x-1/2 bottom-4 left-1/2">
                                @foreach ($foodPlace->businessImages as $index => $img)
                                    <button
                                        class="carousel-indicator w-3 h-3 rounded-full bg-white/80 hover:bg-white transition-all duration-300 {{ $index === 0 ? 'bg-white' : '' }}"
                                        data-index="{{ $index }}"></button>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div
                            class="flex items-center justify-center w-full rounded-lg h-96 bg-gradient-to-r from-gray-200 to-gray-300">
                            <span class="text-lg text-gray-500">No Image Available</span>
                        </div>
                    @endif

                    <!-- Floating Category & Rating Badge - Enhanced -->
                    <div class="absolute flex items-center justify-between bottom-6 left-4 right-4">
                        <span
                            class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 transform bg-orange-500 rounded-full shadow-lg hover:scale-110 hover:bg-orange-600">
                            {{ $foodPlace->category ? $foodPlace->category->name : '-' }}
                        </span>
                        <div
                            class="flex items-center px-4 py-2 text-yellow-600 transition-all duration-300 transform rounded-full shadow-lg bg-white/90 backdrop-blur-sm hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-yellow-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="font-medium">Rating:
                                {{ number_format($foodPlace->reviews->avg('rating'), 1) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Content Section - Enhanced with Subtle Animations -->
                <div class="p-8">
                    <!-- Title & Price Banner - Enhanced -->
                    <div
                        class="flex flex-col items-start justify-between mb-8 space-y-4 md:flex-row md:items-center md:space-y-0">
                        <h1 class="text-3xl font-bold text-gray-800 transition-all duration-300 hover:text-orange-600">
                            {{ $foodPlace->title }}
                        </h1>
                        <div
                            class="px-5 py-3 font-bold text-orange-600 transition-all duration-300 transform rounded-lg shadow-md bg-gradient-to-r from-orange-100 to-orange-50 hover:scale-105 hover:shadow-lg">
                            Rp {{ number_format($foodPlace->min_price, 0, '', '.') }} -
                            Rp {{ number_format($foodPlace->max_price, 0, '', '.') }}
                        </div>
                    </div>

                    <!-- Description - Enhanced -->
                    <div class="mb-8 transition-all duration-500 rounded-lg hover:bg-gray-50 hover:px-4 hover:py-3">
                        <h2 class="flex items-center mb-3 text-xl font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Deskripsi
                        </h2>
                        <p class="leading-relaxed text-gray-600 transition-all duration-300 hover:text-gray-800">
                            {{ $foodPlace->description }}
                        </p>
                    </div>

                    <!-- Location Information - Enhanced -->
                    @if (isset($foodPlace->location))
                        <div
                            class="p-4 mb-8 transition-all duration-500 rounded-lg bg-gradient-to-r from-gray-50 to-white hover:shadow-md">
                            <h2 class="flex items-center mb-3 text-xl font-semibold text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Lokasi
                            </h2>
                            <div class="flex items-start transition-all duration-300 hover:translate-x-1">
                                <span class="text-gray-600">{{ $foodPlace->location }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Menu Section - Enhanced -->
                    <div class="mb-8 transition-all duration-500 hover:shadow-inner">
                        <h2 class="flex items-center mb-3 text-xl font-semibold text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menu Makanan & Minuman
                        </h2>

                        @if ($foodPlace->menuImages->count())
                            <div class="p-4 transition-all duration-500 rounded-lg bg-gray-50 hover:shadow-lg">
                                @if ($foodPlace->menuImages->count() === 1)
                                    <!-- Single menu image -->
                                    <img src="{{ $foodPlace->menuImages->first()->image_url }}"
                                        alt="Menu {{ $foodPlace->title }}"
                                        class="max-w-60 rounded-lg shadow-sm transition-transform duration-500 hover:scale-[1.02] cursor-pointer"
                                        onclick="openImageModal(this.src)" />
                                @else
                                    <!-- Multiple menu images - Grid layout -->
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                        @foreach ($foodPlace->menuImages as $menuImage)
                                            <div class="relative overflow-hidden rounded-lg group">
                                                <img src="{{ $menuImage->image_url }}"
                                                    alt="Menu {{ $foodPlace->title }}"
                                                    class="object-cover w-full h-48 transition-transform duration-500 cursor-pointer modal-trigger hover:scale-110"
                                                    data-image-url="{{ $menuImage->image_url }}"
                                                    onclick="openImageModal('{{ $menuImage->image_url }}')" />
                                                <div
                                                    class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-0 group-hover:bg-opacity-30">
                                                    <svg class="w-8 h-8 text-white transition-opacity duration-300 opacity-0 group-hover:opacity-100"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="p-8 text-center rounded-lg bg-gray-50">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="text-lg text-gray-500">Foto menu belum tersedia</p>
                                <p class="mt-2 text-sm text-gray-400">Pemilik usaha belum mengunggah foto menu</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Map Section - Enhanced with OpenStreetMap -->
            @if (isset($foodPlace->source_location))
                <div
                    class="p-6 mt-8 transition-all duration-500 delay-100 bg-white shadow-lg rounded-xl hover:shadow-xl animate-fade-in-up">
                    <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Peta Lokasi
                    </h2>

                    <!-- Map Container -->
                    <div
                        class="mb-4 overflow-hidden transition-all duration-500 rounded-lg hover:ring-2 hover:ring-orange-200 hover:rounded-xl">
                        <div id="map" class="flex items-center justify-center w-full bg-gray-100 h-96">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-gray-500">Loading map...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ $foodPlace->source_location }}" target="_blank"
                            class="flex items-center justify-center px-4 py-2 text-white transition-colors bg-orange-500 rounded-lg hover:bg-orange-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka di Google Maps
                        </a>

                        <button onclick="shareLocation()"
                            class="flex items-center justify-center px-4 py-2 text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                            </svg>
                            Bagikan Lokasi
                        </button>
                    </div>

                    <!-- Location Info -->
                    <div class="p-3 mt-4 rounded-lg bg-gray-50">
                        <p class="mb-2 text-sm text-gray-600">
                            <strong>Alamat:</strong> {{ $foodPlace->location ?? 'Alamat tidak tersedia' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            💡 Tip: Gunakan aplikasi peta favorit Anda untuk navigasi yang lebih akurat
                        </p>
                    </div>
                </div>
            @endif
            <!-- Add this section right before the Reviews Section -->


            <!-- Reviews Section - Enhanced -->
            <div
                class="p-6 mt-8 transition-all duration-500 delay-200 bg-white shadow-lg rounded-xl hover:shadow-xl animate-fade-in-up">
                <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Ulasan Pengunjung
                </h2>
                <div class="flex justify-end my-8">
                    @auth
                        @if ($userReview)
                            <!-- User already reviewed - Show existing review info -->
                            <div class="flex-1 max-w-sm p-4 mr-4 border border-green-200 rounded-lg bg-green-50">
                                <div class="flex items-center text-green-700">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">Anda sudah memberikan ulasan</span>
                                </div>
                                <p class="mt-1 text-sm text-green-600">
                                    Rating: {{ $userReview->rating }}/5 • {{ $userReview->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <button disabled
                                class="flex items-center px-6 py-1 text-gray-500 bg-gray-300 rounded-full shadow opacity-75 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="font-medium">Sudah Direview</span>
                            </button>
                        @else
                            {{-- Kalau user admin hilangkan button --}}
                            @if (auth()->user()->role !== 'admin')
                                <a href="{{ route('review.index', $foodPlace->id) }}"
                                    class="flex items-center px-6 py-3 text-white transition-all duration-300 transform bg-orange-500 rounded-full shadow hover:bg-orange-600 hover:scale-105 hover:shadow-md active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span class="font-medium">Tulis Review</span>
                                </a>
                            @else
                                <div class="flex-1 max-w-sm p-4 mr-4 border border-gray-200 rounded-lg bg-gray-50">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium">Admin tidak perlu review</span>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @else
                        <!-- User not logged in -->
                        <div class="flex-1 max-w-md p-4 mr-4 border border-gray-200 rounded-lg bg-gray-50">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">Login untuk memberikan ulasan</span>
                            </div>
                        </div>
                        <a href="{{ route('login') }}"
                            class="flex items-center px-6 py-3 text-white transition-all duration-300 transform bg-orange-500 rounded-full shadow hover:bg-orange-600 hover:scale-105 hover:shadow-md active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium">Login</span>
                        </a>
                    @endauth
                </div>
                <div class="space-y-6">
                    @php
                        $reviews = $foodPlace->reviews->where('is_hidden', false)->sortByDesc('created_at');
                    @endphp

                    @forelse ($reviews as $review)
                        <div class="p-6 mb-6 transition-all duration-300 transform border border-gray-200 rounded-xl hover:bg-gray-50 hover:shadow-md hover:-translate-y-1 animate-fade-in-up"
                            style="animation-delay: {{ $loop->index * 50 }}ms">

                            <!-- Review Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="flex items-center mr-3">
                                        <span class="flex text-yellow-500">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $review->rating)
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="inline-block w-5 h-5 transition-all duration-200 transform hover:scale-125"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="inline-block w-5 h-5 text-gray-300 transition-all duration-200"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </span>
                                        <span
                                            class="ml-2 text-sm font-medium text-gray-600">{{ $review->rating }}/5</span>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500 transition-all duration-300 hover:text-gray-700">
                                    {{ $review->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <!-- User Info -->
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-800 transition-all duration-300 hover:text-orange-600">
                                    @if ($review->is_anonymous)
                                        <span class="text-gray-600">Pengguna Anonim</span>
                                    @else
                                        {{ $review->user->name ?? 'Anonymous' }}
                                    @endif
                                </h4>
                            </div>

                            <!-- Detail Ratings -->
                            @if ($review->taste_rating || $review->price_rating || $review->service_rating || $review->ambiance_rating)
                                <div class="p-3 mb-4 rounded-lg bg-gray-50">
                                    <h5 class="mb-2 text-sm font-medium text-gray-700">Rating Detail:</h5>
                                    <div class="grid grid-cols-2 gap-3 text-xs md:grid-cols-4">
                                        @if ($review->taste_rating)
                                            <div class="flex items-center">
                                                <span class="mr-1">🍽️</span>
                                                <span class="mr-1">Rasa:</span>
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $review->taste_rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->price_rating)
                                            <div class="flex items-center">
                                                <span class="mr-1">💰</span>
                                                <span class="mr-1">Harga:</span>
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $review->price_rating ? 'text-green-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->service_rating)
                                            <div class="flex items-center">
                                                <span class="mr-1">🏪</span>
                                                <span class="mr-1">Layanan:</span>
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $review->service_rating ? 'text-blue-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->ambiance_rating)
                                            <div class="flex items-center">
                                                <span class="mr-1">🌟</span>
                                                <span class="mr-1">Suasana:</span>
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $review->ambiance_rating ? 'text-purple-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Comment -->
                            @if ($review->comment)
                                <p
                                    class="mb-4 leading-relaxed text-gray-600 transition-all duration-300 hover:text-gray-800">
                                    {{ $review->comment }}
                                </p>
                            @endif

                            <!-- Tags -->
                            @if ($review->tags && count($review->tags) > 0)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($review->tags as $tag)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-800 bg-orange-100 border border-orange-200 rounded-full">
                                                #{{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Review Photos -->
                            @if ($review->photos && count($review->photos) > 0)
                                <div class="mt-4">
                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                        @foreach ($review->photos as $photo)
                                            <div class="relative cursor-pointer group"
                                                onclick="openImageModal('{{ asset('storage/' . $photo) }}')">
                                                <img src="{{ asset('storage/' . $photo) }}" alt="Review Photo"
                                                    class="object-cover w-full h-24 transition-all duration-300 rounded-lg hover:opacity-90 group-hover:scale-105">
                                                <div
                                                    class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-0 rounded-lg group-hover:bg-opacity-20">
                                                    <svg class="w-6 h-6 text-white transition-all duration-300 opacity-0 group-hover:opacity-100"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Report Review Component for Business Owners -->
                            @include('components.report-review', ['review' => $review])
                        </div>
                    @empty
                        <div class="py-8 text-center text-gray-500 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p class="transition-all duration-500 hover:text-gray-700">Belum ada ulasan untuk tempat makan
                                ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Image Modal with Scroll Support -->
    <div id="imageModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-y-auto bg-black bg-opacity-75"
        onclick="closeImageModal()">
        <div class="flex items-center justify-center w-full min-h-screen px-4 py-8">
            <div class="relative w-auto max-w-4xl mx-auto" onclick="event.stopPropagation()">
                <img id="modalImage" src="" alt="Menu Image"
                    class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl mx-auto">

                <!-- Close Button -->
                <button onclick="closeImageModal()"
                    class="absolute z-10 p-2 text-white transition-colors bg-black bg-opacity-50 rounded-full top-4 right-4 hover:text-gray-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Enhanced Image modal functions with scroll support
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            // Set image source
            modalImage.src = imageSrc;

            // Show modal with flex display and center alignment
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';

            // Prevent body scroll but allow modal scroll
            document.body.style.overflow = 'hidden';

            // Add smooth fade-in animation
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.opacity = '1';
                modal.style.transition = 'opacity 0.3s ease-in-out';
            }, 10);
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');

            // Add fade-out animation
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.3s ease-in-out';

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Prevent modal close when clicking on image
        document.addEventListener('DOMContentLoaded', function() {
            const modalImage = document.getElementById('modalImage');
            if (modalImage) {
                modalImage.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Add event delegation for menu images with class modal-trigger
            document.addEventListener('click', function(e) {
                // Check if clicked element is modal-trigger or inside a container with modal-trigger
                let target = e.target;
                let imageElement = null;

                if (target.classList.contains('modal-trigger')) {
                    // Direct click on image
                    imageElement = target;
                } else {
                    // Check if clicked inside a container that has modal-trigger image
                    const container = target.closest('.relative.group');
                    if (container) {
                        imageElement = container.querySelector('.modal-trigger');
                    }
                }

                if (imageElement) {
                    e.preventDefault();
                    const imageUrl = imageElement.getAttribute('data-image-url') || imageElement.src;
                    openImageModal(imageUrl);
                }
            });

            // Carousel functionality
            const carousel = document.getElementById('image-carousel');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const indicators = document.querySelectorAll('.carousel-indicator');

            let currentIndex = 0;
            const totalSlides = {{ $foodPlace->businessImages->count() }};
            const slideWidth = 100; // 100% width per slide

            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

                // Update indicators
                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.add('bg-white');
                        indicator.classList.remove('bg-white/80');
                    } else {
                        indicator.classList.remove('bg-white');
                        indicator.classList.add('bg-white/80');
                    }
                });
            }

            // Next button click
            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel();
            });

            // Previous button click
            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateCarousel();
            });

            // Indicator click
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });

            // Touch/swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            carousel.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {
                passive: true
            });

            function handleSwipe() {
                const difference = touchStartX - touchEndX;
                if (difference > 50) {
                    // Swipe left - next
                    currentIndex = (currentIndex + 1) % totalSlides;
                } else if (difference < -50) {
                    // Swipe right - previous
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                }
                updateCarousel();
            }
        });

        function shareLocation() {
            const title = '{{ $foodPlace->title }}';
            const location = '{{ $foodPlace->location ?? '' }}';
            const url = '{{ $foodPlace->source_location ?? '' }}';

            if (navigator.share) {
                navigator.share({
                    title: `Lokasi ${title}`,
                    text: `Cek lokasi ${title} di ${location}`,
                    url: url
                });
            } else {
                // Fallback untuk browser yang tidak support Web Share API
                const shareText = `Lokasi ${title} - ${location}\n${url}`;
                navigator.clipboard.writeText(shareText).then(() => {
                    alert('Lokasi telah disalin ke clipboard!');
                }).catch(() => {
                    // Fallback jika clipboard tidak didukung
                    const textArea = document.createElement('textarea');
                    textArea.value = shareText;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    alert('Lokasi telah disalin ke clipboard!');
                });
            }
        }

        // Initialize map (placeholder - bisa diganti dengan OpenStreetMap nanti)
        function initMap() {
            const mapContainer = document.getElementById('map');
            if (mapContainer) {
                // Simple map placeholder dengan styling yang bagus
                mapContainer.innerHTML = `
                    <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-blue-100 to-green-100">
                        <div class="p-6 text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h3 class="mb-2 text-lg font-semibold text-gray-700">{{ $foodPlace->title }}</h3>
                            <p class="mb-4 text-gray-600">{{ $foodPlace->location ?? 'Lokasi tidak tersedia' }}</p>
                            <div class="flex justify-center space-x-2">
                                <span class="px-3 py-1 text-sm text-orange-600 bg-orange-100 rounded-full">📍 Lokasi Tempat</span>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        // Initialize map when page loads
        document.addEventListener('DOMContentLoaded', initMap);
    </script>

    <!-- Add this to your CSS file or style tag -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .carousel-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .snap-x {
            scroll-snap-type: x mandatory;
        }

        .snap-start {
            scroll-snap-align: start;
        }

        /* Modal styles */
        #imageModal.hidden {
            display: none !important;
        }

        #imageModal:not(.hidden) {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        #imageModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        .modal-transition {
            transition: opacity 0.3s ease-in-out;
        }

        /* Ensure image is centered */
        #modalImage {
            display: block;
            margin: 0 auto;
        }
    </style>
@endsection
