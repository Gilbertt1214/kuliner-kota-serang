<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
        <!-- Animasi background floating bubbles -->
        <div class="fixed inset-0 overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-16 h-16 bg-orange-100 rounded-full opacity-30 animate-float1"></div>
            <div class="absolute top-1/3 right-1/4 w-20 h-20 bg-orange-200 rounded-full opacity-20 animate-float2"></div>
            <div class="absolute bottom-1/4 left-1/3 w-24 h-24 bg-orange-100 rounded-full opacity-25 animate-float3"></div>
            <div class="absolute bottom-1/3 right-1/3 w-12 h-12 bg-orange-200 rounded-full opacity-30 animate-float4"></div>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg relative z-10 transform transition-all duration-500 ease-in-out hover:shadow-xl">
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

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 animate-fade-in-down">LOGIN</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address dengan animasi -->
                <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out transform hover:scale-105" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password dengan animasi -->
                <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-300 ease-in-out transform hover:scale-105" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me dengan animasi -->
                <div class="flex items-center justify-between mt-6 animate-fade-in-up" style="animation-delay: 0.3s">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500 transition duration-150 ease-in-out" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-orange-500 hover:text-orange-700 transition duration-150 ease-in-out hover:underline" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <div class="animate-fade-in-up" style="animation-delay: 0.4s">
                    <button type="submit" class="px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md w-full">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center animate-fade-in-up" style="animation-delay: 0.5s">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-700 font-medium transition duration-150 ease-in-out hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>

            <div class="mt-6 animate-fade-in-up" style="animation-delay: 0.6s">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Atau masuk dengan
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
