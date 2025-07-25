@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 border-b border-gray-200 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('pengusaha.food-places.index') }}" class="text-white hover:text-green-200 mr-4">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Daftarkan Tempat Kuliner
                            </h2>
                            <p class="text-green-100 mt-1">Isi informasi lengkap tentang tempat kuliner Anda</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <form id="foodPlaceForm" action="{{ route('pengusaha.food-places.store') }}" method="POST"
                enctype="multipart/form-data" class="space-y-8 bg-white rounded-b-xl shadow-lg">
                @csrf

                <div class="p-8 space-y-8">
                    <!-- Informasi Dasar -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informasi Dasar
                            </h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Nama Tempat -->
                            <div class="space-y-2">
                                <label for="title" class="text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Nama Tempat Kuliner <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan nama tempat kuliner" required>
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="space-y-2">
                                <label for="food_category_id" class="text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    Kategori Kuliner <span class="text-red-500">*</span>
                                </label>
                                <select name="food_category_id" id="food_category_id"
                                    class="w-full px-4 py-3 border @error('food_category_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('food_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('food_category_id')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Harga -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="min_price" class="text-sm font-medium text-gray-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Harga Minimum (Rp) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="min_price" id="min_price" min="0" step="1000"
                                        value="{{ old('min_price') }}"
                                        class="w-full px-4 py-3 border @error('min_price') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                        placeholder="10000" required>
                                    @error('min_price')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="max_price" class="text-sm font-medium text-gray-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Harga Maksimum (Rp) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="max_price" id="max_price" min="0" step="1000"
                                        value="{{ old('max_price') }}"
                                        class="w-full px-4 py-3 border @error('max_price') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                        placeholder="50000" required>
                                    @error('max_price')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="space-y-2">
                                <label for="description" class="text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Deskripsi <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 resize-none"
                                    placeholder="Ceritakan tentang tempat kuliner Anda, menu unggulan, suasana, dll." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Lokasi -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Informasi Lokasi
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Alamat -->
                            <div class="space-y-2">
                                <label for="location" class="text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea name="location" id="location" rows="3"
                                    class="w-full px-4 py-3 border @error('location') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 resize-none"
                                    placeholder="Contoh: Jl. Raya Serang No. 123, Kasemen, Kota Serang, Banten" required>{{ old('location') }}</textarea>
                                @error('location')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Google Maps Link -->
                            <div class="space-y-2">
                                <label for="source_location" class="text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    Google Maps Link
                                </label>
                                <input type="url" name="source_location" id="source_location"
                                    value="{{ old('source_location') }}"
                                    class="w-full px-4 py-3 border @error('source_location') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    placeholder="https://maps.google.com/...">
                                <p class="text-gray-500 text-sm">Link Google Maps untuk lokasi tempat kuliner (opsional)
                                </p>
                                @error('source_location')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Foto Bisnis/Usaha -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Foto Tempat Kuliner <span class="text-red-500">*</span>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Foto eksterior, interior, atau suasana tempat (maksimal 5
                                foto)</p>
                        </div>
                        <div class="p-6">
                            <!-- Upload Area -->
                            <div id="business-upload-area"
                                class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-green-400 hover:bg-green-50 transition-all duration-300 cursor-pointer">
                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    class="hidden" required>
                                <div class="space-y-4">
                                    <div class="flex justify-center">
                                        <svg class="h-16 w-16 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-lg font-medium text-gray-900">Klik untuk upload</span>
                                        <p class="text-gray-600">atau drag & drop foto di sini</p>
                                        <p class="text-sm text-gray-500 mt-2">PNG, JPG, JPEG hingga 2MB per file</p>
                                    </div>
                                </div>
                            </div>

                            @error('images')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            @error('images.*')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"
                                style="display: none;"></div>
                        </div>
                    </div>

                    <!-- Foto Menu -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Foto Menu <span class="text-red-500">*</span>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Foto makanan, minuman, atau daftar harga (maksimal 10
                                foto)</p>
                        </div>
                        <div class="p-6">
                            <!-- Upload Area -->
                            <div id="menu-upload-area"
                                class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 cursor-pointer">
                                <input type="file" id="menu_images" name="menu_images[]" multiple accept="image/*"
                                    class="hidden" required>
                                <div class="space-y-4">
                                    <div class="flex justify-center">
                                        <svg class="h-16 w-16 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-lg font-medium text-gray-900">Klik untuk upload</span>
                                        <p class="text-gray-600">atau drag & drop foto menu di sini</p>
                                        <p class="text-sm text-gray-500 mt-2">PNG, JPG, JPEG hingga 2MB per file</p>
                                    </div>
                                </div>
                            </div>

                            @error('menu_images')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            @error('menu_images.*')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror

                            <!-- Menu Image Preview -->
                            <div id="menu-image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"
                                style="display: none;"></div>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-xl p-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-orange-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-orange-700">
                                    <strong>Tips Foto Menu:</strong> Upload foto menu yang jelas dan menarik untuk
                                    menarik minat pelanggan.
                                    Pastikan pencahayaan baik dan tampilkan variasi menu unggulan Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">Siap untuk mendaftar?</h4>
                            <p class="text-sm text-gray-600 mt-1">Data akan direview oleh admin dalam 1-3 hari kerja</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('pengusaha.dashboard') }}"
                                class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" id="submitBtn"
                                class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                                <svg id="spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span id="submitText">Daftarkan Tempat Kuliner</span>
                            </button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('foodPlaceForm');
            const imageInput = document.getElementById('images');
            const imagePreview = document.getElementById('imagePreview');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const spinner = document.getElementById('spinner');
            const minPriceInput = document.getElementById('min_price');
            const maxPriceInput = document.getElementById('max_price');


            const menuImages = document.getElementById('menu_images');
            const menuImagePreview = document.getElementById('menu-image-preview');

            // Handle upload area clicks
            document.getElementById('business-upload-area').addEventListener('click', function() {
                imageInput.click();
            });

            document.getElementById('menu-upload-area').addEventListener('click', function() {
                menuImages.click();
            });

            // Helper functions for validation
            function validateFileSize(file, maxSize = 2 * 1024 * 1024) {
                return file.size <= maxSize;
            }

            function validateFileType(file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                return allowedTypes.includes(file.type);
            }

            function createImagePreview(file, container) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-full h-24 object-cover rounded-lg border border-gray-300">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                            <span class="text-white text-xs font-medium text-center px-2">${file.name}</span>
                        </div>
                        <div class="absolute top-1 left-1 bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                            ${Math.round(file.size / 1024)}KB
                        </div>
                    `;

                    // For menu images, append to the grid container
                    if (container.id === 'menu-image-preview') {
                        container.querySelector('.grid').appendChild(div);
                    } else {
                        container.appendChild(div);
                    }
                };
                reader.readAsDataURL(file);
            }

            // Image Preview
            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                imagePreview.innerHTML = '';

                if (files.length > 5) {
                    alert('Maksimal 5 gambar yang dapat diupload');
                    e.target.value = '';
                    imagePreview.classList.add('hidden');
                    return;
                }

                if (files.length > 0) {
                    imagePreview.style.display = 'grid';
                    files.forEach((file, index) => {
                        if (file.type.startsWith('image/')) {
                            if (file.size > 2 * 1024 * 1024) { // 2MB
                                alert(`Gambar ${file.name} terlalu besar. Maksimal 2MB.`);
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'relative group';
                                div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-24 object-cover rounded-md border">
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity remove-image" data-index="${index}">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="absolute bottom-1 left-1 bg-black bg-opacity-50 text-white text-xs px-1 rounded">${index + 1}</div>
                        `;
                                imagePreview.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                } else {
                    imagePreview.style.display = 'none';
                }
            });

            // Remove image
            imagePreview.addEventListener('click', function(e) {
                if (e.target.closest('.remove-image')) {
                    const index = parseInt(e.target.closest('.remove-image').dataset.index);
                    const dt = new DataTransfer();
                    const files = Array.from(imageInput.files);

                    files.forEach((file, i) => {
                        if (i !== index) {
                            dt.items.add(file);
                        }
                    });

                    imageInput.files = dt.files;
                    imageInput.dispatchEvent(new Event('change'));
                }
            });
            // Handle menu image upload with enhanced functionality
            if (menuImages) {
                menuImages.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);
                    menuImagePreview.innerHTML = '';

                    if (files.length === 0) {
                        menuImagePreview.style.display = 'none';
                        return;
                    }

                    if (files.length > 10) {
                        alert('Anda hanya boleh memilih maksimal 10 foto untuk menu.');
                        menuImages.value = '';
                        menuImagePreview.style.display = 'none';
                        return;
                    }

                    let invalidFiles = [];
                    let validFiles = [];

                    files.forEach((file, index) => {
                        if (!validateFileType(file)) {
                            invalidFiles.push(`${file.name} (format tidak didukung)`);
                        } else if (!validateFileSize(file)) {
                            invalidFiles.push(`${file.name} (ukuran terlalu besar)`);
                        } else {
                            validFiles.push(file);

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'relative group';
                                div.innerHTML = `
                                    <img src="${e.target.result}" alt="Preview" class="w-full h-24 object-cover rounded-lg border border-gray-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-xs font-medium text-center px-2">${file.name}</span>
                                    </div>
                                    <div class="absolute top-1 left-1 bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                        ${Math.round(file.size / 1024)}KB
                                    </div>
                                `;
                                menuImagePreview.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    if (invalidFiles.length > 0) {
                        alert('File berikut tidak valid:\n' + invalidFiles.join('\n') +
                            '\n\nHanya file JPG, PNG, GIF dengan ukuran maksimal 2MB yang diperbolehkan.'
                        );

                        // Remove invalid files from input
                        const dt = new DataTransfer();
                        validFiles.forEach(file => dt.items.add(file));
                        menuImages.files = dt.files;
                    }

                    if (validFiles.length > 0) {
                        menuImagePreview.style.display = 'grid';
                    } else {
                        menuImagePreview.style.display = 'none';
                    }
                });
            }

            // Add drag and drop functionality for both image types
            const businessUploadArea = document.getElementById('business-upload-area');
            const menuUploadArea = document.getElementById('menu-upload-area');

            // Setup drag and drop for both areas
            [businessUploadArea, menuUploadArea].forEach(area => {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    area.addEventListener(eventName, preventDefaults, false);
                });

                ['dragenter', 'dragover'].forEach(eventName => {
                    area.addEventListener(eventName, (e) => highlight(e, area), false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    area.addEventListener(eventName, (e) => unhighlight(e, area), false);
                });
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e, area) {
                area.classList.add('border-indigo-400', 'bg-indigo-50');
            }

            function unhighlight(e, area) {
                area.classList.remove('border-indigo-400', 'bg-indigo-50');
            }

            // Handle drop for business images
            businessUploadArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                const dataTransfer = new DataTransfer();
                Array.from(files).forEach(file => dataTransfer.items.add(file));
                imageInput.files = dataTransfer.files;
                imageInput.dispatchEvent(new Event('change'));
            }, false);

            // Handle drop for menu images
            menuUploadArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                const dataTransfer = new DataTransfer();
                Array.from(files).forEach(file => dataTransfer.items.add(file));
                menuImages.files = dataTransfer.files;
                menuImages.dispatchEvent(new Event('change'));
            }, false);

            // Price validation
            function validatePrices() {
                const minPrice = parseFloat(minPriceInput.value) || 0;
                const maxPrice = parseFloat(maxPriceInput.value) || 0;

                if (minPrice && maxPrice && minPrice >= maxPrice) {
                    maxPriceInput.setCustomValidity('Harga maksimal harus lebih besar dari harga minimal');
                } else {
                    maxPriceInput.setCustomValidity('');
                }
            }

            minPriceInput.addEventListener('input', validatePrices);
            maxPriceInput.addEventListener('input', validatePrices);

            // Form submission with enhanced validation
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate images
                if (imageInput.files.length === 0) {
                    alert('Silakan upload minimal satu foto tempat kuliner');
                    imageInput.focus();
                    return;
                }

                if (imageInput.files.length > 5) {
                    alert('Maksimal 5 foto tempat kuliner yang dapat diupload');
                    return;
                }

                // Validate menu images
                if (menuImages.files.length === 0) {
                    alert('Silakan upload minimal satu foto menu');
                    menuImages.focus();
                    return;
                }

                if (menuImages.files.length > 10) {
                    alert('Maksimal 10 foto menu yang dapat diupload');
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Sedang Menyimpan...';
                spinner.classList.remove('hidden');

                // Create FormData for file upload
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Success notification with better styling
                            const successMessage = document.createElement('div');
                            successMessage.className =
                                'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                            successMessage.innerHTML = `
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Tempat kuliner berhasil didaftarkan!
                                </div>
                            `;
                            document.body.appendChild(successMessage);

                            setTimeout(() => {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                } else {
                                    window.location.href =
                                        '{{ route('pengusaha.dashboard') }}';
                                }
                            }, 1500);
                        } else {
                            // Error notification
                            const errorMessage = document.createElement('div');
                            errorMessage.className =
                                'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                            errorMessage.innerHTML = `
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    ${data.message || 'Terjadi kesalahan. Silakan coba lagi.'}
                                </div>
                            `;
                            document.body.appendChild(errorMessage);

                            setTimeout(() => {
                                document.body.removeChild(errorMessage);
                            }, 5000);

                            // Reset form state
                            submitBtn.disabled = false;
                            submitText.textContent = 'Daftarkan Tempat Kuliner';
                            spinner.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Network error notification
                        const errorMessage = document.createElement('div');
                        errorMessage.className =
                            'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                        errorMessage.innerHTML = `
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                Terjadi kesalahan jaringan. Silakan coba lagi.
                            </div>
                        `;
                        document.body.appendChild(errorMessage);

                        setTimeout(() => {
                            document.body.removeChild(errorMessage);
                        }, 5000);

                        // Reset form state
                        submitBtn.disabled = false;
                        submitText.textContent = 'Daftarkan Tempat Kuliner';
                        spinner.classList.add('hidden');
                    });
            });
        });
    </script>

    <!-- Custom CSS for enhanced UI -->
    <style>
        /* Image preview animations */
        #imagePreview .relative,
        #menu-image-preview .relative {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* File upload area hover effects */
        .border-dashed:hover {
            border-color: #f59e0b;
            background-color: #fef3e2;
        }

        /* Progress indication for file size */
        .file-size-indicator {
            background: linear-gradient(90deg, #10b981 0%, #fbbf24 70%, #ef4444 100%);
            height: 2px;
            border-radius: 1px;
        }

        /* Success state styling */
        .upload-success {
            border-color: #10b981 !important;
            background-color: #ecfdf5;
        }

        /* Enhanced button states */
        button:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .form-field-focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        /* Tooltip styling */
        .tooltip {
            position: relative;
        }

        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #1f2937;
            color: white;
            padding: 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 10;
        }
    </style>
@endsection
