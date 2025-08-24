@extends('layouts.app')

@section('title', 'Kuliner - Temukan Rekomendasi Kuliner Terbaik')

@section('content')
    <!-- Hero Section with Enhanced Animation -->
    <section class="relative py-16 overflow-hidden text-white bg-gradient-to-br from-orange-600 via-orange-500 to-red-500">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-white rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-white rounded-full animate-ping"></div>
        </div>

        <div class="container relative px-4 mx-auto">
            <div class="flex flex-col md:flex-row items-center min-h-[80vh]">
                <div class="md:w-[45%] mb-8 md:mb-0 pl-0 animate-fade-in-left">
                    <div class="mb-4 inline-block px-4 py-2 bg-white/20 rounded-full backdrop-blur-sm">
                        {{-- <span class="text-sm font-medium">🍽️ Platform #1 Kuliner Serang</span> --}}
                    </div>
                    <h1 class="mb-4 text-4xl font-bold leading-tight md:text-5xl lg:text-6xl bg-gradient-to-r from-white to-orange-100 bg-clip-text text-transparent">
                        Temukan Kuliner Terbaik di Kota Serang
                    </h1>
                    <p class="mb-8 text-xl opacity-90 leading-relaxed">Platform terpercaya untuk menemukan kuliner terbaik Kota Serang.
                        Jelajahi cita rasa autentik dan temukan tempat makan favorit Anda </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('food-places.index') }}"
                            class="px-8 py-4 font-medium text-white transition-all duration-300 transform border-2 border-white rounded-full hover:bg-white hover:text-orange-500 hover:-translate-y-1 hover:shadow-2xl text-center">
                            🔍 Jelajahi Kuliner
                        </a>

                    </div>
                </div>
                <div class="md:w-[55%] animate-fade-in-right">
                    <div class="relative">
                        <img src="{{ asset('images/kotaserang.jpg') }}"
                            class="rounded-3xl shadow-2xl w-full max-h-[500px] object-cover transform transition-all duration-500 hover:scale-105"
                            alt="Kuliner Kota Serang">
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section id="popular-section" class="py-16 bg-gradient-to-br from-orange-50 to-red-50">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-12 animate-fade-in">
            <span class="inline-block px-6 py-2 bg-orange-100 text-orange-600 rounded-full text-sm font-medium mb-4">
                ⭐ PALING DIREKOMENDASIKAN
            </span>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Kuliner Terpopuler</h2>
            <p class="max-w-2xl mx-auto text-gray-600 text-lg">Tempat makan dengan rating tertinggi dan ulasan terbaik dari para food lover di Serang</p>
        </div>

        @php
            // Sort featured places by rating (highest first)
            $popularPlaces = $featuredPlaces->sortByDesc(function($place) {
                return $place->reviews->avg('rating') ?? 0;
            })->take(6);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($popularPlaces as $index => $foodPlace)
                <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-up"
                     style="animation-delay: {{ $index * 0.1 }}s;">

                    <!-- Ranking Badge -->
                    @if($index < 3)
                        <div class="absolute top-4 left-4 z-20">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-white text-lg
                                {{ $index == 0 ? 'bg-gradient-to-r from-yellow-400 to-yellow-600' : '' }}
                                {{ $index == 1 ? 'bg-gradient-to-r from-gray-300 to-gray-500' : '' }}
                                {{ $index == 2 ? 'bg-gradient-to-r from-orange-400 to-orange-600' : '' }}">
                                #{{ $index + 1 }}
                            </div>
                        </div>
                    @endif

                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-64">
                        @if ($foodPlace->images->count() > 0)
                            <img src="{{ $foodPlace->images->first()->image_url }}"
                                alt="{{ $foodPlace->title }}"
                                class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-200 to-gray-300">
                                <span class="text-gray-500 text-lg">🍽️ No Image</span>
                            </div>
                        @endif

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category & Rating Row - DIPERBAIKI -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 text-xs font-medium text-orange-600 bg-orange-100 rounded-full border border-orange-200">
                                {{ $foodPlace->category ? $foodPlace->category->name : 'Umum' }}
                            </span>

                            @php
                                $avgRating = $foodPlace->reviews->avg('rating') ?? 0;
                                $reviewCount = $foodPlace->reviews->count();
                            @endphp

                            <!-- Rating Container - Diperbaiki alignment dan spacing -->
                            <div class="flex items-center">
                                <!-- Stars Container -->
                                <div class="flex items-center space-x-0.5 mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $avgRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <!-- Rating Number -->
                                <span class="text-sm font-medium text-gray-700">
                                    {{ number_format($avgRating, 1) }}
                                </span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition-colors duration-300">
                            {{ $foodPlace->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $foodPlace->description }}</p>

                        <!-- Reviews Summary - DIPERBAIKI -->
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span class="truncate">{{ $reviewCount }} ulasan</span>
                        </div>

                        <!-- Price & Action Row -->
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div>
                                <span class="text-lg font-bold text-orange-600">
                                    Rp {{ number_format($foodPlace->min_price, 0, '', '.') }}
                                </span>
                                @if($foodPlace->max_price > $foodPlace->min_price)
                                    <span class="text-gray-400"> - {{ number_format($foodPlace->max_price, 0, '', '.') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('food-place.show', $foodPlace->id) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                Detail
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Crown for #1 -->
                    @if($index == 0)
                        <div class="absolute -top-2 right-4">
                            <span class="text-2xl animate-bounce">👑</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('food-places.index') }}"
               class="inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                <span class="mr-2">🔍</span>
                Lihat Semua Kuliner
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</section>





    <!-- Latest Recommendations Section -->
    <section class="py-16 bg-white">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between mb-12 animate-fade-in">
                <div>
                    <span class="inline-block px-6 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium mb-4">
                        🆕 TERBARU
                    </span>
                    <h2 class="text-3xl font-bold text-gray-800">Rekomendasi Terbaru</h2>
                    <p class="text-gray-600 mt-2">Tempat makan baru yang baru saja bergabung dengan platform kami</p>
                </div>
                <a href="{{ route('food-places.index') }}"
                    class="hidden md:flex items-center font-medium text-orange-500 transition-all duration-300 transform hover:text-orange-600 hover:translate-x-1">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($featuredPlaces->count() > 0)
                    @foreach ($featuredPlaces->take(3) as $index => $foodPlace)
                        <div class="overflow-hidden transition-all duration-500 delay-100 transform bg-white shadow-lg group rounded-2xl hover:shadow-xl hover:-translate-y-2 animate-fade-in-up border border-gray-100"
                             style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="relative overflow-hidden h-60">
                                @if ($foodPlace->images->count() > 0)
                                    <img src="{{ $foodPlace->images->first()->image_url }}"
                                        alt="{{ $foodPlace->title }}"
                                        class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-200 to-gray-300">
                                        <span class="text-gray-500">🍽️ No Image</span>
                                    </div>
                                @endif

                                <!-- Rating Badge -->
                                @php
                                    $avgRating = $foodPlace->reviews->avg('rating') ?? 0;
                                @endphp
                                <div class="absolute flex items-center px-3 py-1 text-yellow-600 rounded-full shadow-md top-3 right-3 bg-white/90 backdrop-blur-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="ml-1 text-sm font-medium">{{ number_format($avgRating, 1) }}</span>
                                </div>

                                <!-- New Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 text-xs font-bold text-white bg-green-500 rounded-full animate-pulse">NEW</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 text-xs font-medium text-orange-500 bg-orange-100 rounded-full">
                                        {{ $foodPlace->category ? $foodPlace->category->name : '-' }}
                                    </span>
                                </div>
                                <h3 class="mb-2 text-xl font-bold text-gray-800 group-hover:text-orange-600 transition-colors duration-300">{{ $foodPlace->title }}</h3>
                                <p class="mb-4 text-gray-600 line-clamp-2">{{ $foodPlace->description }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-orange-600 text-lg">Rp {{ number_format($foodPlace->min_price, 0, '', '.') }} - {{ number_format($foodPlace->max_price, 0, '', '.') }}</span>
                                    <a href="{{ route('food-place.show', $foodPlace->id) }}"
                                        class="text-sm font-medium text-orange-500 transition-all duration-300 opacity-0 hover:text-orange-600 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0">
                                        Detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center gap-4 py-12 col-span-full">
                        <div class="text-6xl">🍽️</div>
                        <p class="text-gray-500 text-lg">Tidak ada rekomendasi terbaru saat ini.</p>
                        <p class="text-gray-400 text-sm">Kembali lagi nanti untuk melihat tempat makan terbaru!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Enhanced Featured Categories Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container px-4 mx-auto">
            <div class="mb-12 text-center animate-fade-in">
                <span class="inline-block px-6 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-medium mb-4">
                    🏪 KATEGORI
                </span>
                <h2 class="mb-4 text-4xl font-bold text-gray-800">Kategori Kuliner</h2>
                <p class="max-w-2xl mx-auto text-gray-600 text-lg">Jelajahi berbagai kategori kuliner di kota Serang yang menawarkan cita rasa autentik dan pengalaman kuliner tak terlupakan.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                @foreach ($categories as $index => $category)
                    <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:-translate-y-3 hover:shadow-2xl animate-fade-in-up border border-gray-100"
                         style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="p-6 text-center">
                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-all duration-300 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 group-hover:scale-110 group-hover:rotate-6 shadow-lg">
                                @switch($category->name)
                                    @case('Restoran')
                                        <span class="text-2xl">🏪</span>
                                    @break
                                    @case('Kedai Kopi')
                                        <span class="text-2xl">☕</span>
                                    @break
                                    @case('Kedai Makanan')
                                        <span class="text-2xl">🍽️</span>
                                    @break
                                    @case('Warung Makan')
                                        <span class="text-2xl">🏠</span>
                                    @break
                                    @case('Cafe')
                                        <span class="text-2xl">☕</span>
                                    @break
                                    @case('Fast Food')
                                        <span class="text-2xl">🍔</span>
                                    @break
                                    @case('Street Food')
                                        <span class="text-2xl">🚚</span>
                                    @break
                                    @default
                                        <span class="text-2xl">🍴</span>
                                @endswitch
                            </div>

                            <h3 class="mb-2 text-lg font-semibold text-gray-800 transition-colors duration-300 group-hover:text-orange-600">
                                {{ $category->name }}
                            </h3>

                            <p class="mb-4 text-sm text-gray-500">
                                {{ $category->food_places_count ?? 0 }} tempat
                            </p>

                            <div class="transition-all duration-300 transform translate-y-2 opacity-0 group-hover:opacity-100 group-hover:translate-y-0">
                                <a href="{{ route('food-places.index', ['category' => $category->id]) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 rounded-full transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    Jelajahi
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Enhanced Custom Animation Styles -->
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

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
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

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom gradient text */
        .bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
        }

        /* Backdrop blur support */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
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
    </style>
    <script>
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

        </script>
@endsection
