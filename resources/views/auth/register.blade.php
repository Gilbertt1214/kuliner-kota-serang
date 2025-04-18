<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('home') }}" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-2xl font-bold text-gray-800 ml-2">Kuliner Nusantara</span>
                </a>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Buat Akun Baru</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="name" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150 ease-in-out" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150 ease-in-out" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="mt-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                    <select id="role" name="role" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150 ease-in-out" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pengguna</option>
                        <option value="pengusaha" {{ old('role') == 'pengusaha' ? 'selected' : '' }}>Pengusaha Kuliner</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150 ease-in-out" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150 ease-in-out" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-150 ease-in-out w-full">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-700 font-medium transition duration-150 ease-in-out">
                        Masuk Sekarang
                    </a>
                </p>
            </div>

            {{-- <div class="mt-6">
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
                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    <a href="#" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12 12-5.373 12-12S18.628 0 12 0zm6.804 16.864c-.242.52-.566.934-.984 1.244-.468.344-1.033.652-1.691.916-.658.264-1.433.394-2.322.394-.958 0-1.802-.17-2.536-.508-.732-.34-1.354-.786-1.863-1.34-.51-.552-.888-1.178-1.14-1.884-.248-.704-.374-1.432-.374-2.18 0-.788.128-1.534.386-2.238.258-.704.64-1.326 1.142-1.86.502-.536 1.132-.962 1.89-1.272.76-.31 1.632-.466 2.616-.466.968 0 1.812.17 2.536.508.722.338 1.332.782 1.83 1.328.498.546.864 1.16 1.102 1.84.236.68.354 1.384.354 2.108 0 .782-.12 1.53-.364 2.244-.242.716-.604 1.348-1.08 1.896-.478.55-1.09.982-1.834 1.3-.746.316-1.63.476-2.654.476-1.124 0-2.128-.244-3.012-.734-.884-.488-1.566-1.178-2.04-2.066h.216c.144 0 .278-.034.404-.102.126-.068.264-.198.416-.39.152-.192.3-.472.446-.84.144-.37.29-.858.434-1.47l.93.322c.2.694.48 1.232.84 1.616.358.384.838.576 1.44.576.544 0 .982-.168 1.316-.506.332-.336.498-.768.498-1.296 0-.152-.022-.314-.062-.486-.042-.172-.12-.35-.236-.536-.116-.186-.29-.37-.518-.56-.23-.19-.528-.37-.9-.546-.662-.308-1.208-.59-1.638-.852-.43-.26-.764-.534-1.004-.82-.24-.286-.406-.588-.498-.908-.092-.32-.138-.688-.138-1.098 0-.588.12-1.128.356-1.618.238-.492.566-.91.982-1.256.416-.344.912-.612 1.482-.804.572-.19 1.186-.284 1.846-.284.58 0 1.108.078 1.58.232.474.154.88.362 1.222.622.34.262.61.564.81.906.196.342.338.702.426 1.078l-.712.322c-.096-.328-.224-.608-.38-.844-.158-.234-.346-.424-.57-.57-.222-.146-.474-.254-.754-.322-.282-.068-.588-.102-.92-.102-.6 0-1.074.162-1.424.484-.35.324-.524.738-.524 1.244 0 .328.088.61.264.844.176.236.42.456.732.66.314.202.68.398 1.102.59.42.19.874.394 1.36.614.76.352 1.368.68 1.828.984.46.304.816.616 1.068.932.25.318.42.65.508 1 .088.35.134.73.134 1.138 0 .8-.204 1.498-.61 2.096z"/>
                        </svg>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
</x-guest-layout>
