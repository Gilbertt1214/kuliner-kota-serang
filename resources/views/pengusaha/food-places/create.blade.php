@extends('layouts.admin')

@section('content')
    <div class="">
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
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors duration-200">
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
                                        <span>Upload foto tempat</span>
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

                    <!-- Foto Menu -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Foto Menu <span class="text-red-500">*</span>
                            </div>
                        </label>

                        <!-- Upload Area -->
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-orange-400 transition-colors duration-200">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="menu_images"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500">
                                        <span id="menu-file-name">Upload foto menu</span>
                                        <input id="menu_images" name="menu_images[]" type="file" class="sr-only"
                                            multiple accept="image/*" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB (maksimal 10 foto)</p>
                            </div>
                        </div>

                        <!-- Menu Image Preview -->
                        <div id="menu-image-preview" class="mt-4 hidden">
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4"></div>
                        </div>

                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-3">
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

                        @error('menu_images')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('menu_images.*')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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


            const menuImages = document.getElementById('menu_images');
            const menuFileName = document.getElementById('menu-file-name');
            const menuImagePreview = document.getElementById('menu-image-preview');

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
            // Handle menu image upload with enhanced functionality
            if (menuImages) {
                menuImages.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);
                    const gridContainer = menuImagePreview.querySelector('.grid');
                    gridContainer.innerHTML = '';

                    if (files.length === 0) {
                        menuFileName.textContent = 'Upload foto menu';
                        menuFileName.classList.remove('text-green-600', 'font-medium');
                        menuImagePreview.classList.add('hidden');
                        return;
                    }

                    if (files.length > 10) {
                        alert('Anda hanya boleh memilih maksimal 10 foto untuk menu.');
                        menuImages.value = '';
                        menuFileName.textContent = 'Upload foto menu';
                        menuFileName.classList.remove('text-green-600', 'font-medium');
                        menuImagePreview.classList.add('hidden');
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
                            createImagePreview(file, menuImagePreview);
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
                        menuFileName.textContent = `${validFiles.length} foto menu dipilih`;
                        menuFileName.classList.add('text-green-600', 'font-medium');
                        menuImagePreview.classList.remove('hidden');
                    } else {
                        menuFileName.textContent = 'Upload foto menu';
                        menuFileName.classList.remove('text-green-600', 'font-medium');
                        menuImagePreview.classList.add('hidden');
                    }
                });
            }


            // Add drag and drop functionality for both image types
            const businessUploadArea = imageInput.closest('.border-dashed');
            const menuUploadArea = document.querySelector('#menu_images').closest('.border-dashed');

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
