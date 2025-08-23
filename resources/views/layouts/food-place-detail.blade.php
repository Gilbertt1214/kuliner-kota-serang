{{-- resources/views/foodPlace/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    <div class="container px-4 py-8 mx-auto max-w-6xl">

        <!-- Hero Section -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
            <!-- Image Gallery -->
            <div class="relative">
                @if ($foodPlace->businessImages->count())
                    <div class="relative group">
                        <!-- Main Image Container -->
                        <div id="image-carousel" class="flex transition-transform duration-500 ease-in-out">
                            @foreach ($foodPlace->businessImages as $img)
                                <div class="flex-shrink-0 w-full">
                                    <img src="{{ $img->image_url }}"
                                         alt="{{ $foodPlace->title }}"
                                         class="w-full h-80 md:h-96 object-cover" />
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Arrows (only if multiple images) -->
                        @if($foodPlace->businessImages->count() > 1)
                            <button id="prev-btn"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-700 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button id="next-btn"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-700 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            <!-- Image Indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                                @foreach ($foodPlace->businessImages as $index => $img)
                                    <button class="carousel-indicator w-2 h-2 rounded-full bg-white/60 hover:bg-white transition-all duration-300 {{ $index === 0 ? 'bg-white' : '' }}"
                                            data-index="{{ $index }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="h-80 md:h-96 bg-gray-200 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p>Foto tidak tersedia</p>
                        </div>
                    </div>
                @endif

                <!-- Floating Badges -->
                <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                    <span class="bg-orange-500 text-white px-3 py-1.5 rounded-full text-sm font-medium shadow-lg">
                        {{ $foodPlace->category ? $foodPlace->category->name : 'Umum' }}
                    </span>

                    @php
                        $avgRating = $foodPlace->reviews->avg('rating') ?? 0;
                        $reviewCount = $foodPlace->reviews->count();
                    @endphp

                    <div class="bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg flex items-center space-x-1">
                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">{{ number_format($avgRating, 1) }}</span>
                        <span class="text-xs text-gray-500">({{ $reviewCount }})</span>
                    </div>
                </div>
            </div>

            <!-- Restaurant Info -->
            <div class="p-6 md:p-8">
                <!-- Title & Price -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">{{ $foodPlace->title }}</h1>
                    <div class="bg-orange-50 border border-orange-200 px-4 py-2 rounded-lg">
                        <div class="text-orange-600 font-semibold">
                            Rp {{ number_format($foodPlace->min_price, 0, '', '.') }} -
                            Rp {{ number_format($foodPlace->max_price, 0, '', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tentang Tempat Ini
                    </h3>
                    <p class="text-gray-600 leading-relaxed">{{ $foodPlace->description }}</p>
                </div>

                <!-- Location Info -->
                <div class="flex items-center text-gray-600 mb-6">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $foodPlace->location ?? 'Lokasi tidak tersedia' }}</span>
                </div>
            </div>
        </div>

        <!-- Menu Section -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
            <div class="p-6 md:p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Menu
                </h3>

                @if ($foodPlace->menuImages->count())
                    @if ($foodPlace->menuImages->count() === 1)
                        <!-- Single Menu Image -->
                        <div class="max-w-md">
                            <img src="{{ $foodPlace->menuImages->first()->image_url }}"
                                 alt="Menu {{ $foodPlace->title }}"
                                 class="w-full rounded-lg shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-300"
                                 onclick="openImageModal(this.src)" />
                        </div>
                    @else
                        <!-- Multiple Menu Images -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($foodPlace->menuImages as $menuImage)
                                <div class="relative group cursor-pointer" onclick="openImageModal('{{ $menuImage->image_url }}')">
                                    <img src="{{ $menuImage->image_url }}"
                                         alt="Menu {{ $foodPlace->title }}"
                                         class="w-full h-48 object-cover rounded-lg shadow-sm group-hover:shadow-md transition-all duration-300" />
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 rounded-lg transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500 text-lg">Menu belum tersedia</p>
                        <p class="text-gray-400 text-sm mt-2">Pemilik usaha belum mengunggah foto menu</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Location Section -->
        @if (isset($foodPlace->source_location))
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
                <div class="p-6 md:p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Lokasi
                    </h3>

                    <!-- Map Placeholder -->
                    <div class="bg-gradient-to-br from-blue-50 to-green-50 rounded-lg h-64 mb-4 flex items-center justify-center border border-gray-200">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto text-orange-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h4 class="font-semibold text-gray-700 mb-1">{{ $foodPlace->title }}</h4>
                            <p class="text-gray-600 text-sm">{{ $foodPlace->location ?? 'Lokasi tidak tersedia' }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ $foodPlace->source_location }}" target="_blank"
                           class="flex items-center justify-center px-4 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Buka di Google Maps
                        </a>
                        <button onclick="shareLocation()"
                                class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                            </svg>
                            Bagikan Lokasi
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Reviews Section -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 md:p-8">
                <!-- Reviews Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 sm:mb-0 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Ulasan Pengunjung
                    </h3>

                    <!-- Review Action Button -->
                    @auth
                        @if ($userReview)
                            <div class="flex items-center text-green-600 text-sm">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Anda sudah memberikan ulasan
                            </div>
                        @else
                            @if (auth()->user()->role !== 'admin')
                                <a href="{{ route('review.index', $foodPlace->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Tulis Review
                                </a>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login untuk Review
                        </a>
                    @endauth
                </div>

                <!-- Reviews List -->
                <div class="space-y-6">
                    @php
                        $reviews = $foodPlace->reviews->where('is_hidden', false)->sortByDesc('created_at');
                    @endphp

                    @forelse ($reviews as $review)
                        <div class="border border-gray-200 rounded-lg p-6 hover:bg-gray-50 transition-colors duration-200">
                            <!-- Review Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <!-- Rating Stars -->
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-medium text-gray-600">{{ $review->rating }}/5</span>
                                    </div>

                                    <!-- User Name -->
                                    <div>
                                        <h4 class="font-semibold text-gray-900">
                                            {{ $review->is_anonymous ? 'Pengguna Anonim' : ($review->user->name ?? 'Anonymous') }}
                                        </h4>
                                    </div>
                                </div>

                                <!-- Date -->
                                <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>

                            <!-- Review Comment -->
                            @if ($review->comment)
                                <p class="text-gray-700 leading-relaxed mb-4">{{ $review->comment }}</p>
                            @endif

                            <!-- Detailed Ratings -->
                            @if ($review->taste_rating || $review->price_rating || $review->service_rating || $review->ambiance_rating)
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <h5 class="text-sm font-medium text-gray-700 mb-3">Rating Detail:</h5>
                                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 text-sm">
                                        @if ($review->taste_rating)
                                            <div class="flex items-center space-x-2">
                                                <span>🍽️</span>
                                                <span class="text-gray-600">Rasa:</span>
                                                <div class="flex space-x-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="w-2 h-2 rounded-full {{ $i <= $review->taste_rating ? 'bg-yellow-400' : 'bg-gray-300' }}"></div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->price_rating)
                                            <div class="flex items-center space-x-2">
                                                <span>💰</span>
                                                <span class="text-gray-600">Harga:</span>
                                                <div class="flex space-x-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="w-2 h-2 rounded-full {{ $i <= $review->price_rating ? 'bg-green-400' : 'bg-gray-300' }}"></div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->service_rating)
                                            <div class="flex items-center space-x-2">
                                                <span>🏪</span>
                                                <span class="text-gray-600">Layanan:</span>
                                                <div class="flex space-x-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="w-2 h-2 rounded-full {{ $i <= $review->service_rating ? 'bg-blue-400' : 'bg-gray-300' }}"></div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif

                                        @if ($review->ambiance_rating)
                                            <div class="flex items-center space-x-2">
                                                <span>🌟</span>
                                                <span class="text-gray-600">Suasana:</span>
                                                <div class="flex space-x-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="w-2 h-2 rounded-full {{ $i <= $review->ambiance_rating ? 'bg-purple-400' : 'bg-gray-300' }}"></div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Review Tags -->
                            @if ($review->tags && count($review->tags) > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($review->tags as $tag)
                                        <span class="inline-block px-3 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-full">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Review Photos -->
                            @if ($review->photos && count($review->photos) > 0)
                                <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                                    @foreach ($review->photos as $photo)
                                        <img src="{{ asset('storage/' . $photo) }}"
                                             alt="Review Photo"
                                             class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                             onclick="openImageModal('{{ asset('storage/' . $photo) }}')" />
                                    @endforeach
                                </div>
                            @endif

                            <!-- Report Review Component -->
                            @include('components.report-review', ['review' => $review])
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-gray-500 text-lg">Belum ada ulasan</p>
                            <p class="text-gray-400 text-sm mt-1">Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/75" onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-[90vh] mx-4" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-full object-contain rounded-lg">
        <button onclick="closeImageModal()"
                class="absolute -top-10 right-0 text-white hover:text-gray-300 transition-colors duration-200">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<script>
// Image Modal Functions
function openImageModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageSrc;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Share Location Function
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
        const shareText = `Lokasi ${title} - ${location}\n${url}`;
        navigator.clipboard.writeText(shareText).then(() => {
            alert('Lokasi telah disalin ke clipboard!');
        }).catch(() => {
            alert('Gagal menyalin lokasi');
        });
    }
}

// Carousel Functionality
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('image-carousel');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const indicators = document.querySelectorAll('.carousel-indicator');

    if (!carousel || indicators.length <= 1) return;

    let currentIndex = 0;
    const totalSlides = {{ $foodPlace->businessImages->count() }};

    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;

        indicators.forEach((indicator, index) => {
            if (index === currentIndex) {
                indicator.classList.add('bg-white');
                indicator.classList.remove('bg-white/60');
            } else {
                indicator.classList.remove('bg-white');
                indicator.classList.add('bg-white/60');
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
        });
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });

    // Touch/Swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        const difference = touchStartX - touchEndX;

        if (difference > 50) {
            currentIndex = (currentIndex + 1) % totalSlides;
        } else if (difference < -50) {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        }
        updateCarousel();
    }, { passive: true });
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>

<style>
.carousel-indicator {
    transition: all 0.3s ease;
}

.carousel-indicator:hover {
    transform: scale(1.2);
}

/* Modal styles */
#imageModal.hidden {
    display: none !important;
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #fb923c;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #ea580c;
}
</style>
@endsection
