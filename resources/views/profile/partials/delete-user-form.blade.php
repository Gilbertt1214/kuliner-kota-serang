<section class="space-y-6">
    <div class="mb-6">
        <p class="text-gray-600 leading-relaxed">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.') }}
        </p>
    </div>

    <!-- Warning Alert -->
    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
        <div class="flex">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-red-800">Perhatian!</h4>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="space-y-1">
                        <li>• Semua data akun akan dihapus permanen</li>
                        <li>• Review dan komentar Anda akan hilang</li>
                        <li>• Tindakan ini tidak dapat dibatalkan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        {{ __('Hapus Akun Permanen') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <!-- Modal Header -->
            <div class="flex items-center mb-6">
                <div class="flex-shrink-0">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.502 0L4.982 20.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-white">
                        {{ __('Konfirmasi Penghapusan Akun') }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ __('Tindakan ini tidak dapat dibatalkan') }}
                    </p>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="mb-6">
                <p class="text-white leading-relaxed mb-4">
                    {{ __('Apakah Anda yakin ingin menghapus akun? Setelah akun dihapus, semua sumber daya dan data akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun secara permanen.') }}
                </p>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Yang akan dihapus:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>✗ Informasi profil dan akun</li>
                        <li>✗ Semua review dan rating</li>
                        <li>✗ Riwayat aktivitas</li>
                        <li>✗ Pengaturan dan preferensi</li>
                    </ul>
                </div>
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="form-label flex items-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    {{ __('Konfirmasi dengan Kata Sandi') }}
                </label>
                <input id="password" name="password" type="password"
                    class="form-input @error('password', 'userDeletion') border-red-500 @enderror w-full rounded-md"
                    placeholder="{{ __('Masukkan kata sandi Anda') }}" required />
                @error('password', 'userDeletion')
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

            <!-- Modal Footer -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    {{ __('Batal') }}
                </button>

                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
