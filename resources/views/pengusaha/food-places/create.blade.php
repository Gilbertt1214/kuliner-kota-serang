@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-6 pt-28">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('pengusaha.dashboard') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Daftarkan Tempat Kuliner</h1>
                    <p class="text-gray-600">Isi informasi lengkap tentang tempat kuliner Anda</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg">
            <form id="foodPlaceForm" action="{{ route('pengusaha.food-places.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Dasar</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Nama Tempat -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Nama Tempat Kuliner *</label>
                        <input type="text" name="title" id="title"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="food_category_id" class="block text-sm font-medium text-gray-700">Kategori *</label>
                        <select name="food_category_id" id="food_category_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
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
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Range Harga -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="min_price" class="block text-sm font-medium text-gray-700">Harga Minimum (Rp)
                                *</label>
                            <input type="number" name="min_price" id="min_price" min="0" step="1000"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ old('min_price') }}" required>
                            @error('min_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="max_price" class="block text-sm font-medium text-gray-700">Harga Maximum (Rp)
                                *</label>
                            <input type="number" name="max_price" id="max_price" min="0" step="1000"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ old('max_price') }}" required>
                            @error('max_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Alamat Lengkap *</label>
                        <textarea name="location" id="location" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: Jl. Raya Serang No. 123, Kasemen, Kota Serang, Banten" required>{{ old('location') }}</textarea>
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link Google Maps (Opsional) -->
                    <div>
                        <label for="source_location" class="block text-sm font-medium text-gray-700">Link Google Maps
                            (Opsional)</label>
                        <input type="url" name="source_location" id="source_location"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('source_location') }}" placeholder="https://maps.google.com/...">
                        <p class="mt-1 text-xs text-gray-500">Salin link dari Google Maps untuk memudahkan pelanggan
                            menemukan lokasi</p>
                        @error('source_location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi *</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Ceritakan tentang tempat kuliner Anda, menu unggulan, suasana, dll." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Gambar -->
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700">Foto Tempat Kuliner *</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="images"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload foto</span>
                                        <input id="images" name="images[]" type="file" class="sr-only" multiple
                                            accept="image/*" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB (maksimal 5 foto)</p>
                            </div>
                        </div>
                        @error('images')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-5 gap-4 hidden"></div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Data yang Anda submit akan direview oleh admin terlebih dahulu</li>
                                        <li>Proses review memakan waktu 1-3 hari kerja</li>
                                        <li>Pastikan semua informasi yang diisi sudah benar dan lengkap</li>
                                        <li>Upload foto yang berkualitas baik untuk menarik pengunjung</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('pengusaha.dashboard') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </a>
                    <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg id="spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span id="submitText">Daftarkan Tempat Kuliner</span>
                    </button>
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
                    imagePreview.classList.remove('hidden');
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
                    imagePreview.classList.add('hidden');
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

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate images
                if (imageInput.files.length === 0) {
                    alert('Silakan upload minimal satu foto tempat kuliner');
                    return;
                }

                if (imageInput.files.length > 5) {
                    alert('Maksimal 5 foto yang dapat diupload');
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
                            // Success
                            alert('Tempat kuliner berhasil didaftarkan! Menunggu persetujuan admin.');
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                window.location.href = '{{ route('pengusaha.dashboard') }}';
                            }
                        } else {
                            // Error
                            alert(data.message || 'Terjadi kesalahan. Silakan coba lagi.');

                            // Reset form state
                            submitBtn.disabled = false;
                            submitText.textContent = 'Daftarkan Tempat Kuliner';
                            spinner.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan jaringan. Silakan coba lagi.');

                        // Reset form state
                        submitBtn.disabled = false;
                        submitText.textContent = 'Daftarkan Tempat Kuliner';
                        spinner.classList.add('hidden');
                    });
            });
        });
    </script>
@endsection
