{{-- resources/views/foodPlace/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 pt-20">
        <div class="max-w-6xl mx-auto">
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:shadow-xl animate-fade-in-up">
            </div>
            <div
                class="mt-8 bg-white rounded-xl shadow-lg p-6 transition-all duration-500 hover:shadow-xl animate-fade-in-up delay-100">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Ulasan Pengunjung
                </h2>
                <!-- Review Form (only for authenticated users) -->
                @if (auth()->check())
                    @if (isset($userReview) && $userReview)
                        <!-- User already has a review - Show message instead of form -->
                        <div
                            class="mb-8 p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl border-2 border-yellow-200">
                            <div class="flex items-center mb-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-yellow-800">Anda Sudah Memberikan Ulasan</h3>
                                    <p class="text-sm text-yellow-700">Setiap pengguna hanya dapat memberikan satu ulasan
                                        per tempat</p>
                                </div>
                            </div>

                            <!-- Show existing review summary -->
                            <div class="bg-white rounded-lg p-4 border border-yellow-200">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-600 mr-2">Rating Anda:</span>
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $userReview->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                            <span class="ml-1 text-sm text-gray-600">{{ $userReview->rating }}/5</span>
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs text-gray-500">{{ $userReview->created_at->diffForHumans() }}</span>
                                </div>

                                <div class="text-sm text-gray-700 mb-2">
                                    <strong>Komentar:</strong> {{ Str::limit($userReview->comment, 150) }}
                                </div>

                                @if ($userReview->tags)
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        @foreach (json_decode($userReview->tags) as $tag)
                                            <span
                                                class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-200">
                                    <a href="{{ route('food-place.show', $foodPlace->id) }}"
                                        class="text-orange-600 hover:text-orange-700 text-sm font-medium transition-colors">
                                        ← Kembali ke Detail Tempat
                                    </a>
                                    <span class="text-xs text-gray-500">ID Review: #{{ $userReview->id }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- User hasn't reviewed yet - Show the form -->
                        <div
                            class="mb-8 p-6 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl border border-orange-200">
                            <div class="flex items-center mb-6">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-gray-800">Tulis Ulasan Anda</h3>
                                    <p class="text-sm text-gray-600">Bagikan pengalaman Anda untuk membantu pengunjung lain
                                    </p>
                                </div>
                            </div>

                            <!-- Error and Success Messages -->
                            @if (session('success'))
                                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium">Terjadi kesalahan:</p>
                                            <ul class="mt-1 text-sm list-disc list-inside">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('review.store', $foodPlace->id) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6" id="review-form">
                                @csrf

                                <!-- Overall Rating -->
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Rating
                                        Keseluruhan:</label>
                                    <div class="flex items-center space-x-3">
                                        <div class="rating-stars flex space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" id="star{{ $i }}" name="rating"
                                                    value="{{ $i }}" class="hidden"
                                                    {{ $i == 5 ? 'checked' : '' }}>
                                                <label for="star{{ $i }}"
                                                    class="star-label cursor-pointer transition-all duration-300 transform hover:scale-125">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>
                                        <span id="rating-value"
                                            class="text-base font-medium text-gray-700 transition-all duration-300">5
                                            bintang</span>
                                    </div>
                                </div>

                                <!-- Detailed Ratings -->
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Rating Detail (opsional):</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Rasa -->
                                        <div>
                                            <label class="text-xs font-medium text-gray-600 mb-1 block">🍽️ Rasa
                                                Makanan</label>
                                            <div class="flex space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="taste{{ $i }}"
                                                        name="taste_rating" value="{{ $i }}" class="hidden">
                                                    <label for="taste{{ $i }}"
                                                        class="taste-star cursor-pointer">
                                                        <svg class="h-5 w-5 text-gray-300 transition-colors duration-200"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Harga -->
                                        <div>
                                            <label class="text-xs font-medium text-gray-600 mb-1 block">💰 Harga</label>
                                            <div class="flex space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="price{{ $i }}"
                                                        name="price_rating" value="{{ $i }}" class="hidden">
                                                    <label for="price{{ $i }}"
                                                        class="price-star cursor-pointer">
                                                        <svg class="h-5 w-5 text-gray-300 transition-colors duration-200"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Pelayanan -->
                                        <div>
                                            <label class="text-xs font-medium text-gray-600 mb-1 block">🏪
                                                Pelayanan</label>
                                            <div class="flex space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="service{{ $i }}"
                                                        name="service_rating" value="{{ $i }}"
                                                        class="hidden">
                                                    <label for="service{{ $i }}"
                                                        class="service-star cursor-pointer">
                                                        <svg class="h-5 w-5 text-gray-300 transition-colors duration-200"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- Suasana -->
                                        <div>
                                            <label class="text-xs font-medium text-gray-600 mb-1 block">🌟 Suasana</label>
                                            <div class="flex space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="ambiance{{ $i }}"
                                                        name="ambiance_rating" value="{{ $i }}"
                                                        class="hidden">
                                                    <label for="ambiance{{ $i }}"
                                                        class="ambiance-star cursor-pointer">
                                                        <svg class="h-5 w-5 text-gray-300 transition-colors duration-200"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment -->
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <label for="comment"
                                        class="block text-sm font-semibold text-gray-700 mb-2">Komentar:</label>
                                    <textarea name="comment" rows="4" required
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all duration-300 hover:shadow-md resize-none @error('comment') border-red-500 @enderror"
                                        placeholder="Ceritakan pengalaman Anda... (minimal 10 karakter)">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <div class="text-xs text-gray-500 mt-1">💡 Tip: Semakin detail ulasan Anda, semakin
                                        membantu pengunjung lain</div>
                                </div>

                                <!-- Photo Upload -->
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tambahkan Foto
                                        (opsional):</label>
                                    <div class="mt-2">
                                        <div
                                            class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-orange-400 transition-colors">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="review_photos"
                                                        class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500">
                                                        <span>Upload foto</span>
                                                        <input id="review_photos" name="review_photos[]" type="file"
                                                            class="sr-only" multiple accept="image/*"
                                                            onchange="previewImages(this)">
                                                    </label>
                                                    <p class="pl-1">atau drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB (max 3 foto)</p>
                                            </div>
                                        </div>
                                        <div id="image-preview" class="mt-4 hidden">
                                            <div class="grid grid-cols-3 gap-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Tags (pilih yang
                                        sesuai):</label>
                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $tags = [
                                                [
                                                    'name' => 'Enak Banget',
                                                    'emoji' => '😋',
                                                    'color' => 'bg-red-100 text-red-700',
                                                ],
                                                [
                                                    'name' => 'Worth It',
                                                    'emoji' => '💯',
                                                    'color' => 'bg-green-100 text-green-700',
                                                ],
                                                [
                                                    'name' => 'Tempat Nyaman',
                                                    'emoji' => '🏠',
                                                    'color' => 'bg-blue-100 text-blue-700',
                                                ],
                                                [
                                                    'name' => 'Pelayanan Ramah',
                                                    'emoji' => '😊',
                                                    'color' => 'bg-yellow-100 text-yellow-700',
                                                ],
                                                [
                                                    'name' => 'Untuk Keluarga',
                                                    'emoji' => '👨‍👩‍👧‍👦',
                                                    'color' => 'bg-purple-100 text-purple-700',
                                                ],
                                                [
                                                    'name' => 'Instagram-able',
                                                    'emoji' => '📸',
                                                    'color' => 'bg-pink-100 text-pink-700',
                                                ],
                                                [
                                                    'name' => 'Halal',
                                                    'emoji' => '🥗',
                                                    'color' => 'bg-emerald-100 text-emerald-700',
                                                ],
                                                [
                                                    'name' => 'Pedes',
                                                    'emoji' => '🌶️',
                                                    'color' => 'bg-orange-100 text-orange-700',
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($tags as $tag)
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="tags[]" value="{{ $tag['name'] }}"
                                                    class="sr-only">
                                                <span
                                                    class="tag-badge px-3 py-1 rounded-full text-xs font-medium cursor-pointer transition-all duration-300 border-2 border-transparent {{ $tag['color'] }} opacity-60 hover:opacity-100">
                                                    {{ $tag['emoji'] }} {{ $tag['name'] }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Anonymous Option -->
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_anonymous" value="1"
                                            class="rounded border-gray-300 text-orange-600 focus:ring-orange-500"
                                            {{ old('is_anonymous') ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-700">
                                            <span class="font-medium">Posting sebagai anonim</span>
                                            <span class="text-gray-500 block text-xs">Nama Anda tidak akan ditampilkan di
                                                ulasan</span>
                                        </span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end space-x-3">
                                    <button type="button" onclick="clearForm()"
                                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                        Reset
                                    </button>
                                    <button type="submit" id="submit-btn"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 border border-transparent rounded-lg font-semibold text-white hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span class="submit-text">Kirim Ulasan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg text-center">
                        <p class="text-gray-600">Anda perlu <a href="{{ route('login') }}"
                                class="text-orange-500 hover:text-orange-600 font-medium transition-colors duration-300">login</a>
                            untuk menulis ulasan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Global functions for stars management
        let starLabels, ratingValue;

        function updateStars(value) {
            if (ratingValue) {
                ratingValue.textContent = value + ' bintang';
                ratingValue.classList.add('animate-pulse');

                setTimeout(() => {
                    ratingValue.classList.remove('animate-pulse');
                }, 300);
            }

            if (starLabels) {
                starLabels.forEach((label, index) => {
                    const starSvg = label.querySelector('svg');

                    if (index < value) {
                        starSvg.classList.add('text-orange-500');
                        starSvg.classList.remove('text-gray-300', 'text-orange-300');

                        if (index === value - 1) {
                            label.classList.add('animate-bounce');
                            setTimeout(() => {
                                label.classList.remove('animate-bounce');
                            }, 1000);
                        }
                    } else {
                        starSvg.classList.add('text-gray-300');
                        starSvg.classList.remove('text-orange-500', 'text-orange-300');
                    }
                });
            }
        }

        function highlightStars(labels, value, color) {
            labels.forEach((label, index) => {
                const svg = label.querySelector('svg');
                if (index < value) {
                    // Use specific color values instead of Tailwind classes
                    const colorMap = {
                        'text-yellow-400': '#fbbf24',
                        'text-green-400': '#4ade80',
                        'text-blue-400': '#60a5fa',
                        'text-purple-400': '#c084fc'
                    };
                    svg.style.color = colorMap[color] || '#fbbf24';
                    svg.className = 'h-5 w-5 transition-colors duration-200';
                } else {
                    svg.style.color = '#d1d5db'; // gray-300
                    svg.className = 'h-5 w-5 transition-colors duration-200';
                }
            });
        }

        function updateDetailStars(labels, value, color) {
            labels.forEach((label, index) => {
                const svg = label.querySelector('svg');
                if (index < parseInt(value)) {
                    // Use specific color values instead of Tailwind classes
                    const colorMap = {
                        'text-yellow-400': '#fbbf24',
                        'text-green-400': '#4ade80',
                        'text-blue-400': '#60a5fa',
                        'text-purple-400': '#c084fc'
                    };
                    svg.style.color = colorMap[color] || '#fbbf24';
                    svg.className = 'h-5 w-5 transition-colors duration-200';

                    // Add small animation effect
                    svg.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        svg.style.transform = 'scale(1)';
                    }, 150);
                } else {
                    svg.style.color = '#d1d5db'; // gray-300
                    svg.className = 'h-5 w-5 transition-colors duration-200';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Check for session messages and auto-hide them
            const successMessage = document.querySelector('.bg-green-100');
            const errorMessage = document.querySelector('.bg-red-100');

            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.5s ease';
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.remove();
                    }, 500);
                }, 5000);
            }

            const stars = document.querySelectorAll('.rating-stars input');
            ratingValue = document.getElementById('rating-value');
            starLabels = document.querySelectorAll('.star-label');

            // Initialize with default selected value (5 stars)
            updateStars(5);

            // Main rating stars
            stars.forEach(star => {
                star.addEventListener('change', function() {
                    const value = this.value;
                    updateStars(value);
                });

                star.addEventListener('mouseenter', function() {
                    const hoverValue = this.value;
                    starLabels.forEach((label, index) => {
                        const starSvg = label.querySelector('svg');
                        if (index < hoverValue) {
                            starSvg.classList.add('text-orange-300');
                            starSvg.classList.remove('text-gray-300');
                        } else {
                            starSvg.classList.add('text-gray-300');
                            starSvg.classList.remove('text-orange-300');
                        }
                    });
                });

                star.addEventListener('mouseleave', function() {
                    const selectedValue = document.querySelector('.rating-stars input:checked')
                        .value;
                    updateStars(selectedValue);
                });
            });

            // Detail ratings functionality
            setupDetailRatings('taste', 'text-yellow-400');
            setupDetailRatings('price', 'text-green-400');
            setupDetailRatings('service', 'text-blue-400');
            setupDetailRatings('ambiance', 'text-purple-400');

            function setupDetailRatings(category, activeColor) {
                const inputs = document.querySelectorAll(`input[name="${category}_rating"]`);
                const labels = document.querySelectorAll(`.${category}-star`);

                // Event listener for radio button change
                inputs.forEach((input) => {
                    input.addEventListener('change', function() {
                        updateDetailStars(labels, this.value, activeColor);
                    });
                });

                // Event listener for star label click
                labels.forEach((label, index) => {
                    const starValue = index + 1;

                    // Click event to select rating
                    label.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const radioInput = document.querySelector(
                            `input[name="${category}_rating"][value="${starValue}"]`);
                        if (radioInput) {
                            // Uncheck all first
                            inputs.forEach(inp => inp.checked = false);
                            // Check the selected one
                            radioInput.checked = true;
                            updateDetailStars(labels, starValue, activeColor);

                            // Trigger change event manually
                            radioInput.dispatchEvent(new Event('change'));
                        }
                    });

                    // Mouse hover effects
                    label.addEventListener('mouseenter', function() {
                        highlightStars(labels, starValue, activeColor);
                    });

                    label.addEventListener('mouseleave', function() {
                        const selectedInput = document.querySelector(
                            `input[name="${category}_rating"]:checked`);
                        const selectedValue = selectedInput ? selectedInput.value : 0;
                        updateDetailStars(labels, selectedValue, activeColor);
                    });
                });

                // Initialize with no selection (all gray)
                updateDetailStars(labels, 0, activeColor);
            }

            // Tags functionality - Fixed to ensure checkbox works correctly
            const tagBadges = document.querySelectorAll('.tag-badge');
            tagBadges.forEach(badge => {
                badge.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const checkbox = this.parentElement.querySelector('input[type="checkbox"]');

                    // Toggle checkbox state
                    checkbox.checked = !checkbox.checked;

                    // Update visual state
                    if (checkbox.checked) {
                        this.classList.remove('opacity-60');
                        this.classList.add('opacity-100', 'border-orange-300', 'ring-2',
                            'ring-orange-200');
                    } else {
                        this.classList.add('opacity-60');
                        this.classList.remove('opacity-100', 'border-orange-300', 'ring-2',
                            'ring-orange-200');
                    }

                    // Trigger change event
                    checkbox.dispatchEvent(new Event('change'));
                });
            });

            // Additional event listener for checkbox directly
            document.querySelectorAll('input[name="tags[]"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const badge = this.parentElement.querySelector('.tag-badge');
                    if (this.checked) {
                        badge.classList.remove('opacity-60');
                        badge.classList.add('opacity-100', 'border-orange-300', 'ring-2',
                            'ring-orange-200');
                    } else {
                        badge.classList.add('opacity-60');
                        badge.classList.remove('opacity-100', 'border-orange-300', 'ring-2',
                            'ring-orange-200');
                    }
                });
            });

            // Form submission handling
            const form = document.getElementById('review-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Validate required comment field
                    const comment = this.querySelector('textarea[name="comment"]').value.trim();

                    // Check if user is authenticated
                    @if (!auth()->check())
                        e.preventDefault();
                        alert('Anda harus login terlebih dahulu');
                        window.location.href = '{{ route('login') }}';
                        return false;
                    @endif

                    // Check main rating is selected
                    const mainRating = document.querySelector('input[name="rating"]:checked');
                    if (!mainRating) {
                        e.preventDefault();
                        alert('Silakan berikan rating keseluruhan');
                        return false;
                    }

                    // Disable submit button to prevent double submission
                    const submitButton = document.getElementById('submit-btn');
                    const submitText = submitButton.querySelector('.submit-text');
                    const originalText = submitText.textContent;

                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    submitButton.classList.remove('hover:scale-105');

                    submitText.textContent = 'Mengirim...';

                    // Add loading spinner
                    const loadingSpinner = document.createElement('svg');
                    loadingSpinner.className = 'animate-spin -ml-1 mr-3 h-4 w-4 text-white';
                    loadingSpinner.innerHTML = `
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    `;
                    loadingSpinner.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                    loadingSpinner.setAttribute('fill', 'none');
                    loadingSpinner.setAttribute('viewBox', '0 0 24 24');

                    // Replace the send icon with loading spinner
                    const sendIcon = submitButton.querySelector('svg');
                    sendIcon.replaceWith(loadingSpinner);

                    // Re-enable button after timeout (fallback)
                    setTimeout(() => {
                        if (submitButton.disabled) {
                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                            submitButton.classList.add('hover:scale-105');
                            submitText.textContent = originalText;

                            // Restore send icon
                            loadingSpinner.replaceWith(sendIcon);
                        }
                    }, 15000);

                    // Check CSRF token
                    const formData = new FormData(this);
                    const csrfToken = formData.get('_token');
                    if (!csrfToken) {
                        e.preventDefault();
                        alert('Session expired. Silakan refresh halaman dan coba lagi.');

                        // Re-enable button
                        submitButton.disabled = false;
                        submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                        submitText.textContent = originalText;
                        loadingSpinner.replaceWith(sendIcon);

                        return false;
                    }

                    // Allow form to submit
                    return true;
                });
            }
        });

        // Image preview functionality
        function previewImages(input) {
            const preview = document.getElementById('image-preview');
            const gridContainer = preview.querySelector('.grid');

            // Clear existing content
            gridContainer.innerHTML = '';

            if (input.files && input.files.length > 0) {
                preview.classList.remove('hidden');

                // Limit to 3 images
                const files = Array.from(input.files).slice(0, 3);

                files.forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'relative group';
                            div.innerHTML = `
                                <img src="${e.target.result}" class="w-full h-20 object-cover rounded-lg shadow-sm">
                                <button type="button" onclick="removeImage(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors">
                                    ×
                                </button>
                            `;
                            gridContainer.appendChild(div);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                preview.classList.add('hidden');
            }
        }

        function removeImage(index) {
            const input = document.getElementById('review_photos');
            const dt = new DataTransfer();

            Array.from(input.files).forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });

            input.files = dt.files;
            previewImages(input);
        }

        function clearForm() {
            // Reset form
            const form = document.getElementById('review-form');
            if (form) {
                form.reset();
            }

            // Re-enable submit button if disabled
            const submitButton = document.getElementById('submit-btn');
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                submitButton.classList.add('hover:scale-105');

                const submitText = submitButton.querySelector('.submit-text');
                if (submitText) {
                    submitText.textContent = 'Kirim Ulasan';
                }
            }

            // Reset main rating stars to default (5 stars)
            const star5 = document.getElementById('star5');
            if (star5) {
                // Uncheck all rating stars first
                document.querySelectorAll('input[name="rating"]').forEach(star => {
                    star.checked = false;
                });
                // Check star 5
                star5.checked = true;
                updateStars(5);
            } else {
                // Fallback: try to set any 5-star element
                const fallbackStar = document.querySelector('input[name="rating"][value="5"]');
                if (fallbackStar) {
                    document.querySelectorAll('input[name="rating"]').forEach(star => {
                        star.checked = false;
                    });
                    fallbackStar.checked = true;
                    updateStars(5);
                }
            }

            // Reset detail ratings
            const detailRatingInputs = document.querySelectorAll('input[name$="_rating"]');
            detailRatingInputs.forEach(input => {
                input.checked = false;
            });

            // Reset detail star displays
            ['taste', 'price', 'service', 'ambiance'].forEach(category => {
                const labels = document.querySelectorAll(`.${category}-star`);

                if (labels.length > 0) {
                    labels.forEach(label => {
                        const svg = label.querySelector('svg');
                        if (svg) {
                            svg.style.color = '#d1d5db'; // gray-300
                            svg.className = 'h-5 w-5 transition-colors duration-200';
                            svg.style.transform = 'scale(1)'; // Reset any scale transform
                        }
                    });

                    // Also reset using updateDetailStars function
                    updateDetailStars(labels, 0, 'text-gray-300');
                }
            });

            // Reset tags visual state
            const tagBadges = document.querySelectorAll('.tag-badge');
            tagBadges.forEach(badge => {
                badge.classList.add('opacity-60');
                badge.classList.remove('opacity-100', 'border-orange-300', 'ring-2', 'ring-orange-200');
            });

            // Reset all checkboxes (tags and anonymous) 
            const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
            allCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Reset image preview
            const imagePreview = document.getElementById('image-preview');
            if (imagePreview) {
                imagePreview.classList.add('hidden');
                const gridContainer = imagePreview.querySelector('.grid');
                if (gridContainer) {
                    gridContainer.innerHTML = '';
                }
            }

            // Reset file input
            const fileInput = document.getElementById('review_photos');
            if (fileInput) {
                fileInput.value = '';
            }
        }
    </script>

    <style>
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce {
            animation: bounce 0.5s ease;
        }

        .star-label:hover svg {
            transform: scale(1.2);
            transition: transform 0.2s ease;
        }

        /* Detail rating star styles with better specificity */
        .taste-star svg:hover {
            color: #fbbf24 !important;
            /* yellow-400 */
            transform: scale(1.1);
            transition: all 0.2s ease;
        }

        .price-star svg:hover {
            color: #4ade80 !important;
            /* green-400 */
            transform: scale(1.1);
            transition: all 0.2s ease;
        }

        .service-star svg:hover {
            color: #60a5fa !important;
            /* blue-400 */
            transform: scale(1.1);
            transition: all 0.2s ease;
        }

        .ambiance-star svg:hover {
            color: #c084fc !important;
            /* purple-400 */
            transform: scale(1.1);
            transition: all 0.2s ease;
        }

        /* Active state untuk selected detail stars - remove unused CSS */
        .detail-star-selected {
            color: currentColor !important;
        }

        /* Tag badge enhancement */
        .tag-badge {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tag-badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
