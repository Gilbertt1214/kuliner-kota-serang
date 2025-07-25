@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 border-b border-gray-200 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('pengusaha.dashboard') }}" class="text-white hover:text-blue-200 mr-4">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Tempat Kuliner
                            </h2>
                            <p class="text-blue-100 mt-1">Perbarui informasi tempat kuliner Anda</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <form action="{{ route('pengusaha.food-places.update', $foodPlace->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-8 bg-white rounded-b-xl shadow-lg">
                @csrf
                @method('PUT')

                <div class="p-8 space-y-8">
                    <!-- Informasi Dasar -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none"
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Nama Tempat Kuliner <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title" value="{{ old('title', $foodPlace->title) }}"
                                    class="w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan nama tempat kuliner">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    Kategori Kuliner <span class="text-red-500">*</span>
                                </label>
                                <select name="food_category_id" id="food_category_id"
                                    class="w-full px-4 py-3 border @error('food_category_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('food_category_id', $foodPlace->food_category_id) == $category->id ? 'selected' : '' }}>
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
                                        value="{{ old('min_price', $foodPlace->min_price) }}"
                                        class="w-full px-4 py-3 border @error('min_price') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                        placeholder="10000">
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
                                        value="{{ old('max_price', $foodPlace->max_price) }}"
                                        class="w-full px-4 py-3 border @error('max_price') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                        placeholder="50000">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Deskripsi <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 resize-none"
                                    placeholder="Ceritakan tentang tempat kuliner Anda...">{{ old('description', $foodPlace->description) }}</textarea>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
                                    placeholder="Masukkan alamat lengkap tempat kuliner">{{ old('location', $foodPlace->location) }}</textarea>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    Google Maps Link
                                </label>
                                <input type="url" name="source_location" id="source_location"
                                    value="{{ old('source_location', $foodPlace->source_location) }}"
                                    class="w-full px-4 py-3 border @error('source_location') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    placeholder="https://maps.google.com/...">
                                <p class="text-gray-500 text-sm">Link Google Maps untuk lokasi tempat kuliner (opsional)</p>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Foto Bisnis/Usaha
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Foto eksterior, interior, atau suasana tempat</p>
                        </div>
                        <div class="p-6">
                            <!-- Existing Business Images -->
                            @if($foodPlace->images->where('type', 'business')->count() > 0)
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                        Foto Bisnis Saat Ini
                                    </h4>
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="existing-business-images">
                                        @foreach($foodPlace->images->where('type', 'business') as $image)
                                            <div class="relative group bg-gray-50 rounded-lg overflow-hidden">
                                                <img src="{{ Storage::url($image->image_path) }}" alt="Business Photo"
                                                    class="w-full h-32 object-cover">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                                                    <button type="button" onclick="removeExistingImage({{ $image->id }}, 'business')"
                                                        class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Business Image Upload Area -->
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-purple-400 hover:bg-purple-50 transition-all duration-300 cursor-pointer"
                                id="business-upload-area">
                                <input type="file" id="business_images" name="business_images[]" multiple accept="image/*"
                                    class="hidden">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <h4 class="text-lg font-medium text-gray-700 mb-2">Upload Foto Bisnis</h4>
                                    <p class="text-sm text-gray-500 mb-4">Klik atau drag & drop foto di sini</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, WEBP hingga 2MB (maksimal 5 foto)</p>
                                </div>
                            </div>

                            <!-- Business Preview Area -->
                            <div id="business-preview-area" class="mt-6 hidden">
                                <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview Foto Bisnis Baru
                                </h4>
                                <div id="business-preview-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                </div>
                            </div>

                            @error('business_images')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            @error('business_images.*')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
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

                    <!-- Foto Menu -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                Foto Menu
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Foto makanan, minuman, atau daftar harga (opsional)</p>
                        </div>
                        <div class="p-6">
                            <!-- Existing Menu Images -->
                            @if($foodPlace->images->where('type', 'menu')->count() > 0)
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-orange-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                        Foto Menu Saat Ini
                                    </h4>
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="existing-menu-images">
                                        @foreach($foodPlace->images->where('type', 'menu') as $image)
                                            <div class="relative group bg-gray-50 rounded-lg overflow-hidden">
                                                <img src="{{ Storage::url($image->image_path) }}" alt="Menu Photo"
                                                    class="w-full h-32 object-cover">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                                                    <button type="button" onclick="removeExistingImage({{ $image->id }}, 'menu')"
                                                        class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Menu Image Upload Area -->
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-orange-400 hover:bg-orange-50 transition-all duration-300 cursor-pointer"
                                id="menu-upload-area">
                                <input type="file" id="menu_images" name="menu_images[]" multiple accept="image/*"
                                    class="hidden">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <h4 class="text-lg font-medium text-gray-700 mb-2">Upload Foto Menu</h4>
                                    <p class="text-sm text-gray-500 mb-4">Klik atau drag & drop foto di sini</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, WEBP hingga 2MB (maksimal 10 foto)</p>
                                </div>
                            </div>

                            <!-- Menu Preview Area -->
                            <div id="menu-preview-area" class="mt-6 hidden">
                                <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-orange-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview Foto Menu Baru
                                </h4>
                                <div id="menu-preview-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                </div>
                            </div>

                            @error('menu_images')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            @error('menu_images.*')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
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

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 px-8 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Perbarui Tempat Kuliner
                        </button>
                        <a href="{{ route('pengusaha.dashboard') }}"
                            class="flex-1 sm:flex-none bg-gray-500 text-white py-4 px-8 rounded-xl font-semibold hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden input for images to be deleted -->
    <input type="hidden" id="images-to-delete" name="images_to_delete" value="">
@endsection

@push('scripts')
<script>
    let businessFiles = [];
    let menuFiles = [];
    let imagesToDelete = [];

    // Business Images Handler
    document.getElementById('business-upload-area').addEventListener('click', function(e) {
        if (e.target.id !== 'business_images') {
            document.getElementById('business_images').click();
        }
    });

    document.getElementById('business_images').addEventListener('change', function(e) {
        handleImageUpload(e, 'business', businessFiles, 5);
    });

    // Menu Images Handler
    document.getElementById('menu-upload-area').addEventListener('click', function(e) {
        if (e.target.id !== 'menu_images') {
            document.getElementById('menu_images').click();
        }
    });

    document.getElementById('menu_images').addEventListener('change', function(e) {
        handleImageUpload(e, 'menu', menuFiles, 10);
    });

    // Handle image upload function
    function handleImageUpload(event, type, filesArray, maxFiles) {
        const files = Array.from(event.target.files);
        const previewArea = document.getElementById(`${type}-preview-area`);
        const previewGrid = document.getElementById(`${type}-preview-grid`);
        
        // Check file limit
        if (files.length > maxFiles) {
            alert(`Maksimal ${maxFiles} foto untuk ${type === 'business' ? 'bisnis' : 'menu'}`);
            return;
        }

        // Clear existing files array and preview
        filesArray.length = 0;
        previewGrid.innerHTML = '';

        if (files.length > 0) {
            previewArea.classList.remove('hidden');
            
            files.forEach((file, index) => {
                // Validate file type and size
                if (!file.type.startsWith('image/')) {
                    alert('Hanya file gambar yang diperbolehkan');
                    return;
                }
                
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert(`File ${file.name} terlalu besar. Maksimal 2MB`);
                    return;
                }

                filesArray.push(file);
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'relative group bg-gray-50 rounded-lg overflow-hidden';
                    imageDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                            <button type="button" onclick="removeNewImage(${index}, '${type}')"
                                class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    `;
                    previewGrid.appendChild(imageDiv);
                };
                reader.readAsDataURL(file);
            });
            
            updateFileInput(type, filesArray);
        } else {
            previewArea.classList.add('hidden');
        }
    }

    // Remove new image from preview
    function removeNewImage(index, type) {
        const filesArray = type === 'business' ? businessFiles : menuFiles;
        const previewArea = document.getElementById(`${type}-preview-area`);
        const previewGrid = document.getElementById(`${type}-preview-grid`);
        
        filesArray.splice(index, 1);
        
        // Rebuild preview
        previewGrid.innerHTML = '';
        
        if (filesArray.length > 0) {
            filesArray.forEach((file, newIndex) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'relative group bg-gray-50 rounded-lg overflow-hidden';
                    imageDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                            <button type="button" onclick="removeNewImage(${newIndex}, '${type}')"
                                class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    `;
                    previewGrid.appendChild(imageDiv);
                };
                reader.readAsDataURL(file);
            });
        } else {
            previewArea.classList.add('hidden');
        }
        
        updateFileInput(type, filesArray);
    }

    // Remove existing image
    function removeExistingImage(imageId, type) {
        if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            // Add to delete list
            imagesToDelete.push(imageId);
            document.getElementById('images-to-delete').value = imagesToDelete.join(',');
            
            // Remove from UI
            event.target.closest('.relative').remove();
            
            // Check if no existing images left
            const existingImagesContainer = document.getElementById(`existing-${type}-images`);
            if (existingImagesContainer && existingImagesContainer.children.length === 0) {
                existingImagesContainer.closest('.mb-6').style.display = 'none';
            }
        }
    }

    // Update file input
    function updateFileInput(type, filesArray) {
        const input = document.getElementById(`${type}_images`);
        const dt = new DataTransfer();
        
        filesArray.forEach(file => {
            dt.items.add(file);
        });
        
        input.files = dt.files;
    }

    // Drag and drop functionality
    ['business-upload-area', 'menu-upload-area'].forEach(areaId => {
        const area = document.getElementById(areaId);
        const type = areaId.includes('business') ? 'business' : 'menu';
        
        area.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-400', 'bg-blue-50');
        });

        area.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
        });

        area.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
            
            const files = e.dataTransfer.files;
            const input = document.getElementById(`${type}_images`);
            input.files = files;
            
            const event = new Event('change', { bubbles: true });
            input.dispatchEvent(event);
        });
    });
</script>
@endpush
