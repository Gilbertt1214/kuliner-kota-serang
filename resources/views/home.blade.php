@extends('layouts.app')

@section('title', 'Kuliner Nusantara - Temukan Rekomendasi Kuliner Terbaik')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-orange-600 to-orange-400 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Temukan Kuliner Terbaik di Indonesia</h1>
                    <p class="text-xl mb-6">Jelajahi kekayaan kuliner nusantara dari Sabang sampai Merauke. Temukan rekomendasi kuliner terbaik untuk semua selera.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="px-6 py-3 bg-white text-orange-500 font-medium rounded-lg hover:bg-gray-100 transition duration-300">Jelajahi Sekarang</a>
                        <a href="#" class="px-6 py-3 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-orange-500 transition duration-300">Lihat Kategori</a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://nibble-images.b-cdn.net/nibble/original_images/tempat_makan_di_jakarta_03_3abdaaac44.jpg" alt="Kuliner Indonesia" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 -mt-10 relative z-10">
                <form action="#" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex-grow">
                        <input type="text" placeholder="Cari kuliner atau lokasi..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div class="md:w-1/4">
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="">Semua Kategori</option>
                            <option value="makanan-berat">Makanan Berat</option>
                            <option value="makanan-ringan">Makanan Ringan</option>
                            <option value="jajanan-pasar">Jajanan Pasar</option>
                            <option value="minuman">Minuman</option>
                            <option value="dessert">Dessert</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition duration-300">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Categories Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Kategori Kuliner</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jelajahi berbagai kategori kuliner nusantara yang menawarkan cita rasa autentik dari seluruh penjuru Indonesia.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Category 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://th.bing.com/th/id/OIP.lmwV09nFhECNJqpUxKyqCAHaE6?w=242&h=181&c=7&r=0&o=5&pid=1.7" alt="Makanan Berat" class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">Makanan Berat</h3>
                        <p class="text-gray-600 mt-2">50+ Menu</p>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://th.bing.com/th/id/OIP.lmwV09nFhECNJqpUxKyqCAHaE6?w=242&h=181&c=7&r=0&o=5&pid=1.7" alt="Makanan Ringan" class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">Makanan Ringan</h3>
                        <p class="text-gray-600 mt-2">30+ Menu</p>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://th.bing.com/th/id/OIP.lmwV09nFhECNJqpUxKyqCAHaE6?w=242&h=181&c=7&r=0&o=5&pid=1.7" alt="Jajanan Pasar" class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">Jajanan Pasar</h3>
                        <p class="text-gray-600 mt-2">40+ Menu</p>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://th.bing.com/th/id/OIP.lmwV09nFhECNJqpUxKyqCAHaE6?w=242&h=181&c=7&r=0&o=5&pid=1.7" alt="Minuman" class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">Minuman</h3>
                        <p class="text-gray-600 mt-2">25+ Menu</p>
                    </div>
                </div>

                <!-- Category 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://th.bing.com/th/id/OIP.lmwV09nFhECNJqpUxKyqCAHaE6?w=242&h=181&c=7&r=0&o=5&pid=1.7" alt="Dessert" class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-800">Dessert</h3>
                        <p class="text-gray-600 mt-2">35+ Menu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Restaurants Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Rekomendasi Terbaru</h2>
                <a href="#" class="text-orange-500 hover:text-orange-600 font-medium flex items-center">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Restaurant 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://nibble-images.b-cdn.net/nibble/original_images/tempat_makan_di_jakarta_03_3abdaaac44.jpg" alt="Warung Nasi Padang" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-2 py-1 rounded">Makanan Berat</span>
                            <div class="flex items-center ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-600 text-sm ml-1">4.8</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Warung Nasi Padang Sederhana</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">Menyajikan berbagai masakan Padang autentik dengan bumbu rempah yang khas dan menggugah selera.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Jakarta Selatan
                            </span>
                            <span class="text-orange-500 font-medium">Rp 15.000 - 50.000</span>
                        </div>
                    </div>
                </div>
                <!-- Restaurant 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://nibble-images.b-cdn.net/nibble/original_images/tempat_makan_di_jakarta_03_3abdaaac44.jpg" alt="Warung Nasi Padang" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-2 py-1 rounded">Makanan Berat</span>
                            <div class="flex items-center ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-600 text-sm ml-1">4.8</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Warung Nasi Padang Sederhana</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">Menyajikan berbagai masakan Padang autentik dengan bumbu rempah yang khas dan menggugah selera.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Jakarta Selatan
                            </span>
                            <span class="text-orange-500 font-medium">Rp 15.000 - 50.000</span>
                        </div>
                    </div>
                </div>
                <!-- Restaurant 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://nibble-images.b-cdn.net/nibble/original_images/tempat_makan_di_jakarta_03_3abdaaac44.jpg" alt="Warung Nasi Padang" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-2 py-1 rounded">Makanan Berat</span>
                            <div class="flex items-center ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-600 text-sm ml-1">4.8</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Warung Nasi Padang Sederhana</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">Menyajikan berbagai masakan Padang autentik dengan bumbu rempah yang khas dan menggugah selera.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Jakarta Selatan
                            </span>
                            <span class="text-orange-500 font-medium">Rp 15.000 - 50.000</span>
                        </div>
                    </div>
                </div>
                <!-- Restaurant 2 -->
            </div>
        </div>
    </section>
