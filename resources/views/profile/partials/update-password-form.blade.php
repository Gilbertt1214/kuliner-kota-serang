<section>
    <div class="mb-6">
        <p class="text-gray-600 leading-relaxed">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman. Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol.') }}
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="space-y-2">
            <label for="update_password_current_password" class="form-label flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                {{ __('Kata Sandi Saat Ini') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="form-input @error('current_password', 'updatePassword') border-red-500 @enderror w-full rounded-md"
                autocomplete="current-password" placeholder="Masukkan kata sandi saat ini" />
            @error('current_password', 'updatePassword')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="space-y-2">
            <label for="update_password_password" class="form-label flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                {{ __('Kata Sandi Baru') }}
            </label>
            <input id="update_password_password" name="password" type="password"
                class="form-input @error('password', 'updatePassword') border-red-500 @enderror w-full rounded-md"
                autocomplete="new-password" placeholder="Minimal 8 karakter dengan kombinasi huruf dan angka" />
            @error('password', 'updatePassword')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="form-label flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('Konfirmasi Kata Sandi Baru') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-input @error('password_confirmation', 'updatePassword') border-red-500 @enderror w-full rounded-md"
                autocomplete="new-password" placeholder="Ulangi kata sandi baru" />
            @error('password_confirmation', 'updatePassword')
                <p class="text-red-500 text-sm mt-1 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Strength Indicator -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
            <div class="flex">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div class="ml-3">
                    <h4 class="text-sm font-medium text-blue-800">Tips Kata Sandi yang Kuat:</h4>
                    <ul class="mt-2 text-sm text-blue-700 space-y-1">
                        <li>• Minimal 8 karakter</li>
                        <li>• Kombinasi huruf besar dan kecil</li>
                        <li>• Gunakan angka dan simbol</li>
                        <li>• Hindari informasi personal</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between pt-4">
            <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                {{ __('Perbarui Kata Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90" x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center px-4 py-2 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ __('Kata sandi berhasil diperbarui!') }}
                </div>
            @endif
        </div>
    </form>
</section>
