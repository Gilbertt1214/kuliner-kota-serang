{{-- resources/views/foodPlace/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 pt-20">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section with Back Button - Enhanced Animation -->
            <div class="mb-6 flex items-center">
                <a href="{{ route('food-places.index') }}"
                    class="flex items-center rounded-full px-4 py-2 bg-orange-100 text-orange-500 hover:text-orange-600 hover:bg-orange-200 transition-all duration-300 transform hover:-translate-x-1 hover:scale-105 shadow hover:shadow-md active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">Kembali ke Daftar</span>
                </a>
            </div>

            <!-- Main Content Card - Added Entrance Animation -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:shadow-xl animate-fade-in-up">
                <!-- Hero Image Section - Enhanced Carousel with Navigation -->
                <div class="relative group">
                    @if ($foodPlace->images->count())
                        <!-- Carousel Container -->
                        <div class="relative overflow-hidden">
                            <!-- Slides Container -->
                            <div id="image-carousel" class="flex transition-transform duration-500 ease-in-out">
                                @foreach ($foodPlace->images as $img)

                                    <div class="w-full flex-shrink-0">
                                        <div class="relative h-96 w-full">
                                            <img src="{{ asset("storage/".$img->image_path) }}" alt="{{ $foodPlace->title }}"
                                                class="h-full w-full object-cover rounded-lg shadow" />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent rounded-lg">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Navigation Arrows -->
                            <button id="prev-btn"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 text-orange-500 rounded-full p-2 shadow-md hover:bg-white transition-all duration-300 opacity-0 group-hover:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button id="next-btn"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 text-orange-500 rounded-full p-2 shadow-md hover:bg-white transition-all duration-300 opacity-0 group-hover:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                                @foreach ($foodPlace->images as $index => $img)
                                    <button
                                        class="carousel-indicator w-3 h-3 rounded-full bg-white/80 hover:bg-white transition-all duration-300 {{ $index === 0 ? 'bg-white' : '' }}"
                                        data-index="{{ $index }}"></button>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div
                            class="w-full h-96 bg-gradient-to-r from-gray-200 to-gray-300 flex items-center justify-center rounded-lg">
                            <span class="text-gray-500 text-lg">No Image Available</span>
                        </div>
                    @endif

                    <!-- Floating Category & Rating Badge - Enhanced -->
                    <div class="absolute bottom-6 left-4 right-4 flex justify-between items-center">
                        <span
                            class="bg-orange-500 text-white text-sm font-medium px-4 py-2 rounded-full shadow-lg transform transition-all duration-300 hover:scale-110 hover:bg-orange-600">
                            {{ $foodPlace->category ? $foodPlace->category->name : '-' }}
                        </span>
                        <div
                            class="bg-white/90 backdrop-blur-sm text-yellow-600 rounded-full px-4 py-2 flex items-center shadow-lg transform transition-all duration-300 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20"
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
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
                        <h1 class="text-3xl font-bold text-gray-800 transition-all duration-300 hover:text-orange-600">
                            {{ $foodPlace->title }}
                        </h1>
                        <div
                            class="bg-gradient-to-r from-orange-100 to-orange-50 text-orange-600 font-bold px-5 py-3 rounded-lg shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            Rp {{ number_format($foodPlace->min_price, 0, '', '.') }} -
                            Rp {{ number_format($foodPlace->max_price, 0, '', '.') }}
                        </div>
                    </div>

                    <!-- Description - Enhanced -->
                    <div class="mb-8 transition-all duration-500 hover:bg-gray-50 hover:px-4 hover:py-3 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Deskripsi
                        </h2>
                        <p class="text-gray-600 leading-relaxed transition-all duration-300 hover:text-gray-800">
                            {{ $foodPlace->description }}
                        </p>
                    </div>

                    <!-- Location Information - Enhanced -->
                    @if (isset($foodPlace->location))
                        <div
                            class="mb-8 p-4 rounded-lg bg-gradient-to-r from-gray-50 to-white transition-all duration-500 hover:shadow-md">
                            <h2 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500"
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
                        <h2 class="text-xl font-semibold text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menu
                        </h2>
                        <div class="bg-gray-50 p-4 rounded-lg transition-all duration-500 hover:shadow-lg">
                            <img src="{{ $foodPlace->menu }}" alt="Menu"
                                class="w-full rounded-lg shadow-sm transition-transform duration-500 hover:scale-[1.02]" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section - Enhanced -->
            @if (isset($foodPlace->source_location))
                <div
                    class="mt-8 bg-white rounded-xl shadow-lg p-6 transition-all duration-500 hover:shadow-xl animate-fade-in-up delay-100">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Peta Lokasi
                    </h2>
                    <div
                        class="rounded-lg overflow-hidden transition-all duration-500 hover:ring-2 hover:ring-orange-200 hover:rounded-xl">
                        <iframe src="{{ $foodPlace->source_location }}" width="100%" height="450" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="transition-all duration-500 hover:opacity-90"></iframe>
                    </div>
                    <div class="mt-4 text-gray-600">
                        <p>Untuk petunjuk arah, silakan klik <a href="{{ $foodPlace->source_location }}"
                                target="_blank" class="text-orange-500 hover:underline">di sini</a>.</p>
                    </div>
                </div>
            @endif
            <!-- Add this section right before the Reviews Section -->


            <!-- Reviews Section - Enhanced -->
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6 transition-all duration-500 hover:shadow-xl animate-fade-in-up delay-200">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Ulasan Pengunjung
                </h2>
                <div class="mt-8 flex justify-end">
    <a href="{{ route('review.index',$foodPlace->id) }}"
        class="flex items-center rounded-full px-6 py-3 bg-orange-500 text-white hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 shadow hover:shadow-md active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        <span class="font-medium">Tulis Review</span>
    </a>
</div>
                <div class="space-y-6">
    @php
        $reviews = $foodPlace->reviews->sortByDesc('created_at');
    @endphp

    @forelse ($reviews as $review)
        <div class="p-4 border-b border-gray-200 last:border-0 transition-all duration-300 hover:bg-gray-50 rounded-lg transform hover:-translate-y-1 animate-fade-in-up" style="animation-delay: {{ $loop->index * 50 }}ms">
            <div class="flex items-center mb-3">
                <div class="flex items-center mr-3">
                    <span class="text-yellow-500 flex">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $review->rating)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block transition-all duration-200 transform hover:scale-125"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-gray-300 transition-all duration-200"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endif
                        @endfor
                    </span>
                </div>
                <span class="text-sm text-gray-500 transition-all duration-300 hover:text-gray-700">{{ $review->created_at->diffForHumans() }}</span>
            </div>
            <div class="mb-2">
                <h4 class="font-semibold text-gray-800 transition-all duration-300 hover:text-orange-600">{{ $review->user->name ?? 'Anonymous' }}</h4>
            </div>
            <p class="text-gray-600 leading-relaxed transition-all duration-300 hover:text-gray-800">{{ $review->comment }}</p>
        </div>
    @empty
        <div class="text-center py-8 text-gray-500 animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <p class="transition-all duration-500 hover:text-gray-700">Belum ada ulasan untuk tempat makan ini.</p>
        </div>
    @endforelse
</div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('image-carousel');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const indicators = document.querySelectorAll('.carousel-indicator');

            let currentIndex = 0;
            const totalSlides = {{ $foodPlace->images->count() }};
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
    </style>
@endsection
