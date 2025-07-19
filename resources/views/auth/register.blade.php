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

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Ada beberapa error:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

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

                <!-- Role Selection -->
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
                                    <p class="text-xs text-gray-500">saya ingin mendaftarkan usaha</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pengusaha Fields -->
                <div id="pengusaha-fields" class="space-y-4 mt-4" style="display: none;">
                    <div class="p-4 bg-orange-50 rounded-lg border border-orange-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m5 0v-4a1 1 0 011-1h2a1 1 0 011 1v4M7 7h10M7 11h4"></path>
                            </svg>
                            Informasi Usaha
                        </h3>

                        <!-- Nama Usaha -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Nama Usaha <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi Usaha -->
                        <div class="space-y-2 mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Usaha <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">{{ old('description') }}</textarea>
                            <p class="text-sm text-gray-500">Jelaskan tentang usaha kuliner Anda, menu spesial, jam operasional, dll.</p>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                            @error('pengusaha_category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="space-y-2 mt-4">
                            <label for="pengusaha_location" class="block text-sm font-medium text-gray-700">Alamat Usaha <span class="text-red-500">*</span></label>
                            <input type="text" name="pengusaha_location" id="pengusaha_location" value="{{ old('pengusaha_location') }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out">
                            <p class="text-sm text-gray-500">Masukkan alamat lengkap usaha Anda.</p>
                            @error('pengusaha_location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Google Maps Link -->
                        <div class="space-y-2 mt-4">
                            <label for="source_location" class="block text-sm font-medium text-gray-700">Link Google Maps</label>
                            <input type="url" name="source_location" id="source_location" value="{{ old('source_location') }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out" placeholder="https://maps.google.com/...">
                            <p class="text-sm text-gray-500">Tambahkan link Google Maps untuk lokasi usaha Anda (opsional).</p>
                            @error('source_location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Usaha -->
                        <div class="space-y-2 mt-4">
                            <label for="pengusaha_image" class="block text-sm font-medium text-gray-700">
                                Foto Usaha <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <label class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none cursor-pointer transition duration-300 ease-in-out transform hover:scale-105">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span id="business-file-name">Pilih Foto Usaha (Maksimal 5 foto)</span>
                                    </div>
                                    <input type="file" name="pengusaha_image[]" id="pengusaha_image" multiple accept="image/*" class="hidden">
                                </label>
                            </div>
                            <div id="business-image-preview" class="mt-2 grid
                            grid-cols-2 md:grid-cols-3 gap-2">
                        </div>
                            <p class="text-sm text-gray-500">
                                Unggah foto usaha Anda (Max: 2MB per file, Format: JPG, PNG, maksimal 5 foto).
                            </p>
                            @error('pengusaha_image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Menu -->
                        {{-- <div class="space-y-2 mt-6">
    <label class="block text-sm font-medium text-gray-700">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Menu Makanan/Minuman <span class="text-red-500">*</span>
        </div>
    </label>

    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-md font-semibold text-gray-800">Daftar Menu</h4>
            <button type="button" id="add-menu-item" class="px-3 py-2 bg-orange-500 text-white text-sm rounded-lg hover:bg-orange-600 transition duration-200 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Menu
            </button>
        </div>

        <div id="menu-items-container" class="space-y-4">
            <!-- Menu item template akan ditambahkan di sini via JavaScript -->
        </div>

        <div id="no-menu-message" class="text-center py-8 text-gray-500">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p>Belum ada menu yang ditambahkan</p>
            <p class="text-sm">Klik "Tambah Menu" untuk menambahkan item menu</p>
        </div>
    </div>

    @error('menu_items')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div> --}}
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 animate-fade-in-up" style="animation-delay: 0.5s">
                    <button type="submit" class="px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md w-full">
                        <span id="submit-text">Daftar</span>
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center animate-fade-in-up" style="animation-delay: 0.6s">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-700 font-medium transition duration-150 ease-in-out hover:underline">
                        Masuk Sekarang
                    </a>
                </p>
            </div>

            <!-- Social Login -->
            <div class="mt-6 animate-fade-in-up" style="animation-delay: 0.7s">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Atau daftar dengan</span>
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
        document.addEventListener('DOMContentLoaded', function () {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const pengusahaFields = document.getElementById('pengusaha-fields');
            const submitText = document.getElementById('submit-text');

            // Image upload elements
            const pengusahaImage = document.getElementById('pengusaha_image');
            const businessFileName = document.getElementById('business-file-name');
            const businessImagePreview = document.getElementById('business-image-preview');

            const menuImages = document.getElementById('menu_images');
            const menuFileName = document.getElementById('menu-file-name');
            const menuImagePreview = document.getElementById('menu-image-preview');

            function togglePengusahaFields() {
                const selectedRole = document.querySelector('input[name="role"]:checked');
                if (selectedRole && selectedRole.value === 'pengusaha') {
                    pengusahaFields.style.display = 'block';
                    pengusahaFields.classList.add('animate-fade-in-up');
                    if (submitText) submitText.textContent = 'Daftarkan Usaha';
                    setPengusahaFieldsRequired(true);
                } else {
                    pengusahaFields.style.display = 'none';
                    if (submitText) submitText.textContent = 'Daftar';
                    setPengusahaFieldsRequired(false);
                }
            }

            function setPengusahaFieldsRequired(required) {
                const requiredFields = [
                    'title',
                    'description',
                    'pengusaha_category',
                    'min_price',
                    'max_price',
                    'pengusaha_location',
                    'pengusaha_image',
                    'menu_images'
                ];
                requiredFields.forEach(fieldName => {
                    const field = document.getElementById(fieldName);
                    if (field != null) {
                        if (required) {
                            field.setAttribute('required', 'required');
                        } else {
                            field.removeAttribute('required');
                        }
                    }
                });
            }

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
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative group';
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}"
                             alt="Preview"
                             class="w-full h-24 object-cover rounded-lg border border-gray-300">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                            <span class="text-white text-xs font-medium">${file.name}</span>
                        </div>
                    `;
                    container.appendChild(previewDiv);
                };
                reader.readAsDataURL(file);
            }

            // Handle business image upload
            if (pengusahaImage) {
                pengusahaImage.addEventListener('change', function(e) {
                    const files = e.target.files;
                    businessImagePreview.innerHTML = '';

                    if (files.length === 0) {
                        businessFileName.textContent = 'Pilih Foto Usaha (Maksimal 5 foto)';
                        return;
                    }

                    if (files.length > 5) {
                        alert('Anda hanya boleh memilih maksimal 5 foto untuk usaha.');
                        pengusahaImage.value = '';
                        businessFileName.textContent = 'Pilih Foto Usaha (Maksimal 5 foto)';
                        return;
                    }

                    let invalidFiles = [];
                    let validFiles = [];

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        if (!validateFileType(file)) {
                            invalidFiles.push(`${file.name} (format tidak didukung)`);
                        } else if (!validateFileSize(file)) {
                            invalidFiles.push(`${file.name} (ukuran terlalu besar)`);
                        } else {
                            validFiles.push(file);
                            createImagePreview(file, businessImagePreview);
                        }
                    }

                    if (invalidFiles.length > 0) {
                        alert('File berikut tidak valid:\n' + invalidFiles.join('\n') + '\n\nHanya file JPG, PNG dengan ukuran maksimal 2MB yang diperbolehkan.');
                    }

                    if (validFiles.length > 0) {
                        businessFileName.textContent = `${validFiles.length} foto usaha dipilih`;
                    } else {
                        businessFileName.textContent = 'Pilih Foto Usaha (Maksimal 5 foto)';
                        pengusahaImage.value = '';
                    }
                });
            }

            // Handle menu image upload
            if (menuImages) {
                menuImages.addEventListener('change', function(e) {
                    const files = e.target.files;
                    menuImagePreview.innerHTML = '';

                    if (files.length === 0) {
                        menuFileName.textContent = 'Pilih Foto Menu (Maksimal 10 foto)';
                        return;
                    }

                    if (files.length > 10) {
                        alert('Anda hanya boleh memilih maksimal 10 foto untuk menu.');
                        menuImages.value = '';
                        menuFileName.textContent = 'Pilih Foto Menu (Maksimal 10 foto)';
                        return;
                    }

                    let invalidFiles = [];
                    let validFiles = [];

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];

                        if (!validateFileType(file)) {
                            invalidFiles.push(`${file.name} (format tidak didukung)`);
                        } else if (!validateFileSize(file)) {
                            invalidFiles.push(`${file.name} (ukuran terlalu besar)`);
                        } else {
                            validFiles.push(file);
                            createImagePreview(file, menuImagePreview);
                        }
                    }

                    if (invalidFiles.length > 0) {
                        alert('File berikut tidak valid:\n' + invalidFiles.join('\n') + '\n\nHanya file JPG, PNG dengan ukuran maksimal 2MB yang diperbolehkan.');
                    }

                    if (validFiles.length > 0) {
                        menuFileName.textContent = `${validFiles.length} foto menu dipilih`;
                    } else {
                        menuFileName.textContent = 'Pilih Foto Menu (Maksimal 10 foto)';
                        menuImages.value = '';
                    }
                });
            }

            // Role change handlers
            roleRadios.forEach(radio => {
                radio.addEventListener('change', togglePengusahaFields);
            });

            // Initialize
            togglePengusahaFields();
        });
    </script>

    <!-- CSS Animations -->
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

        /* Custom scrollbar for image preview areas */
        #business-image-preview::-webkit-scrollbar,
        #menu-image-preview::-webkit-scrollbar {
            height: 4px;
        }

        #business-image-preview::-webkit-scrollbar-track,
        #menu-image-preview::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        #business-image-preview::-webkit-scrollbar-thumb,
        #menu-image-preview::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        #business-image-preview::-webkit-scrollbar-thumb:hover,
        #menu-image-preview::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</x-guest-layout>
