<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
        <!-- Animasi background floating bubbles -->
        <div class="fixed inset-0 overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-orange-100 rounded-full opacity-30 animate-float1"></div>
            <div class="absolute top-1/3 right-1/4 w-20 h-20 bg-orange-200 rounded-full opacity-20 animate-float2"></div>
            <div class="absolute bottom-1/4 left-1/3 w-24 h-24 bg-orange-100 rounded-full opacity-25 animate-float3"></div>
            <div class="absolute bottom-1/3 right-1/3 w-12 h-12 bg-orange-200 rounded-full opacity-30 animate-float4"></div>
        </div>

        <div class="w-full sm:max-w-2xl mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg relative z-10 transform transition-all duration-500 ease-in-out hover:shadow-xl">
            <!-- Logo dengan animasi bounce -->
            <div class="flex justify-center mb-6 animate-bounce">
                <a href="{{ route('home') }}" class="flex items-center">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500 group-hover:text-orange-600 transition-all duration-300 transform group-hover:rotate-12" viewBox="0 0 24 24" fill="currentColor">
    <!-- Utensil Set Icon -->
    <path d="M8 1a2 2 0 0 1 2 2v2h4V3a2 2 0 1 1 4 0v2a3 3 0 0 1 3 3v1a3 3 0 0 1-3 3v7a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-7a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3V3a2 2 0 0 1 2-2z"/>
    <!-- Plate/Bowl -->
    <path d="M4 10a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1 1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z" fill="#fff"/>
    <!-- Food (noodles or garnish) -->
    <path d="M5 12h14v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-1z" fill="#f59e0b" opacity="0.8"/>
</svg>
                    <span class="text-2xl font-bold text-gray-800 ml-2">Santara</span>
                </a>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 animate-fade-in-down">REGISTER</h2>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="name" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out transform hover:scale-105" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4 animate-fade-in-up" style="animation-delay: 0.2s">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out transform hover:scale-105" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->


                <!-- Password -->
                <div class="mt-4 animate-fade-in-up" style="animation-delay: 0.3s">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out transform hover:scale-105" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 animate-fade-in-up" style="animation-delay: 0.4s">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out transform hover:scale-105" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 animate-fade-in-up" style="animation-delay: 0.25s">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-3">Daftar Sebagai</label>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="border border-gray-300 rounded-lg p-3 hover:border-orange-500 transition-colors duration-200">
                            <div class="flex items-start">
                                <input id="role_user" name="role" type="radio" value="user" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 mt-1" {{ old('role') == 'user' ? 'checked' : '' }} required>
<label for="role_user" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                                    <div class="flex items-center mb-1">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Pelanggan</span>
                                    </div>
                                    <p class="text-xs text-gray-500">Saya ingin mencari tempat</p>
                                </label>
                            </div>
                        </div>
                        <div class="border border-gray-300 rounded-lg p-3 hover:border-orange-500 transition-colors duration-200">
                            <div class="flex items-start">
                                <input id="role_pengusaha" name="role" type="radio" value="pengusaha" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 mt-1" {{ old('role') == 'pengusaha' ? 'checked' : '' }} required>
                                <label for="role_pengusaha" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">
                                    <div class="flex items-center mb-1">
                                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m5 0v-4a1 1 0 011-1h2a1 1 0 011 1v4M7 7h10M7 11h4"></path>
                                        </svg>
                                        <span>Pengusaha</span>
                                    </div>
                                    <p class="text-xs text-gray-500">saya ingin mendaftarkan usaha </p>
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- pengusaha Fields (Hidden by default, shown when role = pengusaha) -->
                <div id="pengusaha-fields" class="space-y-4 mt-4" style="display: none;">
                    <div class="p-4 bg-orange-50 rounded-lg border border-orange-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m5 0v-4a1 1 0 011-1h2a1 1 0 011 1v4M7 7h10M7 11h4"></path>
                            </svg>
                            Informasi Usaha
                        </h3>

                        <!-- pengusaha Title -->
                        <div class="space-y-2">
                            <label for="pengusaha_title" class="block text-sm font-medium text-gray-700">Nama Usaha <span class="text-red-500">*</span></label>
                            <input type="text" name="pengusaha_title" id="pengusaha_title" value="{{ old('pengusaha_title') }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                        </div>

                        <!-- pengusaha Description -->
                        <div class="space-y-2 mt-4">
                            <label for="pengusaha_description" class="block text-sm font-medium text-gray-700">Deskripsi Usaha <span class="text-red-500">*</span></label>
                            <textarea name="pengusaha_description" id="pengusaha_description" rows="3" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">{{ old('pengusaha_description') }}</textarea>
                            <p class="text-sm text-gray-500">Jelaskan tentang usaha kuliner Anda, menu spesial, jam operasional, dll.</p>
                        </div>

                        <!-- Category -->
                        <div class="space-y-2 mt-4">
                            <label for="pengusaha_category" class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                            <select name="pengusaha_category" id="pengusaha_category" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                                <option value="">Pilih Kategori</option>
                                @foreach ($foodCategories as $foodCategory)
                                    <option value="{{ $foodCategory->id }}" {{ old('pengusaha_category') == $foodCategory->id ? 'selected' : '' }}>{{ $foodCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Min Price -->
                            <div class="space-y-2">
                                <label for="min_price" class="block text-sm font-medium text-gray-700">Harga Minimum (Rp) <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="min_price" id="min_price" value="{{ old('min_price') }}" min="0" class="block w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                                </div>
                                @error('min_price')
                                    <p class="text-red-500 text-sm mt-1">with error: {{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Max Price -->
                            <div class="space-y-2">
                                <label for="max_price" class="block text-sm font-medium text-gray-700">Harga Maksimum (Rp) <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="max_price" id="max_price" value="{{ old('max_price') }}" min="0" class="block w-full pl-12 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                                </div>
                                @error('max_price')
                                    <p class="text-red-500 text-sm mt-1">with error: {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="space-y-2 mt-4">
                            <label for="pengusaha_location" class="block text-sm font-medium text-gray-700">Alamat Usaha <span class="text-red-500">*</span></label>
                            <input type="text" name="pengusaha_location" id="pengusaha_location" value="{{ old('pengusaha_location') }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                            <p class="text-sm text-gray-500">Masukkan alamat lengkap usaha Anda.</p>
                        </div>

                        <!-- Google Maps Link -->
                        <div class="space-y-2 mt-4">
                            <label for="source_location" class="block text-sm font-medium text-gray-700">Link Google Maps</label>
                            <input type="url" name="source_location" id="source_location" value="{{ old('source_location') }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out" placeholder="https://maps.google.com/...">
                            <p class="text-sm text-gray-500">Tambahkan link Google Maps untuk lokasi usaha Anda (opsional).</p>
                        </div>

                        <!-- Image Upload -->
                        <div class="space-y-2 mt-4">
                            <label for="pengusaha_image" class="block text-sm font-medium text-gray-700">
                                Foto Usaha <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 flex items-center">
                                <div class="w-full">
                                    <label
                                        class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none cursor-pointer transition duration-300 ease-in-out transform hover:scale-105"
                                    >
                                        <span id="file-name">Pilih Foto kuliner</span>
                                        <input
                                            type="file"
                                            name="pengusaha_image[]"
                                            id="pengusaha_image"
                                            accept="image/*"
                                            multiple
                                            class="sr-only"
                                            onchange="previewImages(this)"
                                        >
                                    </label>
                                </div>
                            </div>
                            <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
                            <p class="text-sm text-gray-500">
                                Unggah foto usaha Anda (Max: 2MB per file, Format: JPG, PNG, maksimal 5 foto).
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 animate-fade-in-up" style="animation-delay: 0.5s">
                    <button type="submit" class="px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md w-full">
                        <span id="submit-text">Daftar</span>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center animate-fade-in-up" style="animation-delay: 0.6s">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-700 font-medium transition duration-150 ease-in-out hover:underline">
                        Masuk Sekarang
                    </a>
                </p>
            </div>

            <div class="mt-6 animate-fade-in-up" style="animation-delay: 0.7s">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Atau daftar dengan
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 ease-in-out transform hover:scale-105">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    <a href="{{ route('auth.google') }}" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300 ease-in-out transform hover:scale-105">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#EA4335" d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.69 0 3.218.6 4.418 1.582L19.91 3C17.782 1.145 15.055 0 12 0 7.27 0 3.198 2.698 1.24 6.65l4.026 3.115Z" />
                            <path fill="#34A853" d="M16.04 18.013c-1.09.703-2.474 1.078-4.04 1.078a7.077 7.077 0 0 1-6.723-4.823l-4.04 3.067A11.965 11.965 0 0 0 12 24c2.933 0 5.735-1.043 7.834-3l-3.793-2.987Z" />
                            <path fill="#4A90E2" d="M19.834 21c2.195-2.048 3.62-5.096 3.62-9 0-.71-.109-1.473-.272-2.182H12v4.637h6.436c-.317 1.559-1.17 2.766-2.395 3.558L19.834 21Z" />
                            <path fill="#FBBC05" d="M5.277 14.268A7.12 7.12 0 0 1 4.909 12c0-.782.125-1.533.357-2.235L1.24 6.65A11.934 11.934 0 0 0 0 12c0 1.92.445 3.73 1.237 5.335l4.04-3.067Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const pengusahaFields = document.getElementById('pengusaha-fields');
            const submitText = document.getElementById('submit-text');
            const pengusahaImage = document.getElementById('pengusaha_image');
            const fileName = document.getElementById('file-name');
            const imagePreview = document.getElementById('image-preview');

            // Toggle pengusaha fields based on role selection
            function togglepengusahaFields() {
                const selectedRole = document.querySelector('input[name="role"]:checked');
                if (selectedRole && selectedRole.value === 'pengusaha') {
                    if (pengusahaFields) {
                        pengusahaFields.style.display = 'block';
                        pengusahaFields.classList.add('animate-fade-in-up');
                    }
                    if (submitText) submitText.textContent = 'Daftarkan Usaha';

                    // Make pengusaha fields required
                    setpengusahaFieldsRequired(true);
                } else {
                    if (pengusahaFields) pengusahaFields.style.display = 'none';
                    if (submitText) submitText.textContent = 'Daftar';

                    // Remove required from pengusaha fields
                    setpengusahaFieldsRequired(false);
                }
            }

            // Set required attribute for pengusaha fields
            function setpengusahaFieldsRequired(required) {
                const requiredFields = [
                    'pengusaha_title',
                    'pengusaha_description',
                    'pengusaha_category',
                    'min_price',
                    'max_price',
                    'pengusaha_location',
                    'pengusaha_image'
                ];

                requiredFields.forEach(fieldName => {
                    const field = document.getElementById(fieldName);
                    if (field) {
                        if (required) {
                            field.setAttribute('required', 'required');
                        } else {
                            field.removeAttribute('required');
                        }
                    }
                });
            }

            // Add event listeners to role radios
            roleRadios.forEach(radio => {
                radio.addEventListener('change', togglepengusahaFields);
            });

            // Image preview functionality for multiple files
            if (pengusahaImage) {
                pengusahaImage.addEventListener('change', function(e) {
                    const files = e.target.files;
                    imagePreview.innerHTML = '';
                    if(files.length === 0){
                        fileName.textContent = 'Pilih Foto (max 5)';
                        imagePreview.classList.add('hidden');
                        return;
                    }

                    if(files.length > 5){
                        alert('Anda hanya boleh memilih maksimal 5 foto.');
                        pengusahaImage.value = '';
                        fileName.textContent = 'Pilih Foto (max 5)';
                        imagePreview.classList.add('hidden');
                        return;
                    }

                    fileName.textContent = `${files.length} file dipilih`;

                    let invalidFile = false;
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        if(file.size > 2 * 1024 * 1024){
                            alert(`File ${file.name} terlalu besar. Maksimal 2MB.`);
                            invalidFile = true;
                            break;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = `Preview Foto ${i + 1}`;
                            img.className = 'h-40 w-auto object-cover rounded-lg';
                            imagePreview.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }

                    if(invalidFile){
                        pengusahaImage.value = '';
                        fileName.textContent = 'Pilih Foto (max 5)';
                        imagePreview.innerHTML = '';
                        imagePreview.classList.add('hidden');
                        return;
                    }

                    imagePreview.classList.remove('hidden');
                });
            }
            // Initialize on page load
            togglepengusahaFields();
        });
    </script>

    <!-- Tambahkan style untuk animasi -->
    <style>
        @keyframes float1 {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(10px); }
        }
        @keyframes float2 {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(15px) translateX(-15px); }
        }
        @keyframes float3 {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-15px) translateX(-10px); }
        }
        @keyframes float4 {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(10px) translateX(15px); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .animate-float1 { animation: float1 8s ease-in-out infinite; }
        .animate-float2 { animation: float2 10s ease-in-out infinite; }
        .animate-float3 { animation: float3 12s ease-in-out infinite; }
        .animate-float4 { animation: float4 9s ease-in-out infinite; }
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-shake { animation: shake 0.5s ease-in-out; }
        .animate-bounce { animation: bounce 2s infinite; }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</x-guest-layout>
