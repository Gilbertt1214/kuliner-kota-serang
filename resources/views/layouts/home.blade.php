@extends('layouts.app')

@section('title', 'Kuliner - Temukan Rekomendasi Kuliner Terbaik')

@section('content')
    <!-- Hero Section with Animation -->
    <section class="bg-gradient-to-r from-orange-600 to-orange-400 text-white py-16 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center min-h-[80vh]">
                <div class="md:w-[45%] mb-8 md:mb-0 pl-0 md:pl-10 animate-fade-in-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Temukan Kuliner Terbaik di Kota Serang</h1>
                    <p class="text-xl mb-6 opacity-90">Jelajahi kekayaan kuliner nusantara dari Sabang sampai Merauke. Temukan rekomendasi kuliner terbaik untuk semua selera.</p>
                    <div class="flex space-x-4">
                        {{-- <a href="#" class="px-6 py-3 bg-white text-orange-500 font-medium rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg">Jelajahi Sekarang</a> --}}
                        <a href="{{ route('food-places.index') }}" class="px-6 py-3 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-orange-500 transition-all duration-300 transform hover:-translate-y-1">Lihat Kategori</a>
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
                <form action="#" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex-grow relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Cari kuliner atau lokasi..."
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="md:w-1/4 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <select class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent appearance-none transition-all duration-300">
                            <option value="">Semua Kategori</option>
                            <option value="makanan-berat">Makanan Berat</option>
                            <option value="makanan-ringan">Makanan Ringan</option>
                            <option value="jajanan-pasar">Jajanan Pasar</option>
                            <option value="minuman">Minuman</option>
                            <option value="dessert">Dessert</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                                class="w-full md:w-auto px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Categories Section with Hover Effects -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Kategori Kuliner</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi berbagai kategori kuliner di kota serang yang menawarkan cita rasa autentik.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <!-- Category 1 -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl animate-fade-in-up delay-100">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://source.unsplash.com/random/600x400/?food,heavy"
                             alt="Makanan Berat"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Makanan Berat</h3>
                        <p class="text-gray-600 text-sm">50+ Menu</p>
                        <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-orange-500 text-sm font-medium hover:text-orange-600">Lihat Semua →</a>
                        </div>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl animate-fade-in-up delay-150">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://source.unsplash.com/random/600x400/?snack"
                             alt="Makanan Ringan"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Makanan Ringan</h3>
                        <p class="text-gray-600 text-sm">30+ Menu</p>
                        <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-orange-500 text-sm font-medium hover:text-orange-600">Lihat Semua →</a>
                        </div>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl animate-fade-in-up delay-200">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://source.unsplash.com/random/600x400/?market,food"
                             alt="Jajanan Pasar"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Jajanan Pasar</h3>
                        <p class="text-gray-600 text-sm">40+ Menu</p>
                        <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-orange-500 text-sm font-medium hover:text-orange-600">Lihat Semua →</a>
                        </div>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl animate-fade-in-up delay-250">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://source.unsplash.com/random/600x400/?drink"
                             alt="Minuman"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Minuman</h3>
                        <p class="text-gray-600 text-sm">25+ Menu</p>
                        <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-orange-500 text-sm font-medium hover:text-orange-600">Lihat Semua →</a>
                        </div>
                    </div>
                </div>

                <!-- Category 5 -->
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:-translate-y-2 hover:shadow-xl animate-fade-in-up delay-300">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://source.unsplash.com/random/600x400/?dessert"
                             alt="Dessert"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Dessert</h3>
                        <p class="text-gray-600 text-sm">35+ Menu</p>
                        <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="#" class="text-orange-500 text-sm font-medium hover:text-orange-600">Lihat Semua →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Restaurants Section with Staggered Animation -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8 animate-fade-in">
                <h2 class="text-3xl font-bold text-gray-800">Rekomendasi Terbaru</h2>
                <a href="#" class="text-orange-500 hover:text-orange-600 font-medium flex items-center transition-all duration-300 transform hover:translate-x-1">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Restaurant 1 -->
                <div class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-2 animate-fade-in-up delay-100">
                    <div class="relative h-60 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400/?restaurant,padang"
                             alt="Warung Nasi Padang"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-3 right-3 bg-white/90 text-yellow-600 rounded-full px-3 py-1 flex items-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm ml-1">4.8</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-3 py-1 rounded-full">Makanan Berat</span>
                            <div class="ml-auto flex items-center text-gray-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                1.2 km
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Warung Nasi Padang Sederhana</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">Menyajikan berbagai masakan Padang autentik dengan bumbu rempah yang khas dan menggugah selera.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-orange-500 font-medium">Rp 15.000 - 50.000</span>
                            <a href="#" class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-all duration-300 opacity-0 group-hover:opacity-100">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Restaurant 2 -->
                <div class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-2 animate-fade-in-up delay-150">
                    <div class="relative h-60 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400/?restaurant,sundanese"
                             alt="Restoran Sunda"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-3 right-3 bg-white/90 text-yellow-600 rounded-full px-3 py-1 flex items-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm ml-1">4.5</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-3 py-1 rounded-full">Makanan Berat</span>
                            <div class="ml-auto flex items-center text-gray-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                0.8 km
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Sunda Kelapa Resto</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">Hidangan khas Sunda dengan suasana tradisional yang nyaman dan harga terjangkau.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-orange-500 font-medium">Rp 20.000 - 75.000</span>
                            <a href="#" class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-all duration-300 opacity-0 group-hover:opacity-100">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Restaurant 3 -->
                <div class="group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl transform hover:-translate-y-2 animate-fade-in-up delay-200">
                    <div class="relative h-60 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400/?restaurant,seafood"
                             alt="Seafood Restaurant"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-3 right-3 bg-white/90 text-yellow-600 rounded-full px-3 py-1 flex items-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm ml-1">4.7</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-3 py-1 rounded-full">Seafood</span>
                            <div class="ml-auto flex items-center text-gray-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                2.5 km
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Dermaga Seafood</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">Seafood segar langsung dari nelayan dengan berbagai pilihan bumbu dan pengolahan.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-orange-500 font-medium">Rp 30.000 - 120.000</span>
                            <a href="#" class="text-sm text-orange-500 hover:text-orange-600 font-medium transition-all duration-300 opacity-0 group-hover:opacity-100">
                                Detail →
                            </a>
                        </div>
                    </div>
                </div>
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
