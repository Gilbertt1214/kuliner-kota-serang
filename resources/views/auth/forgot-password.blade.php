<x-guest-layout>
    <!-- Tambahkan CSS untuk animasi -->
    <style>
        /* Animasi fade-in untuk konten form */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animasi untuk input focus */
        .input-animation {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .input-animation:focus {
            box-shadow: 0 0 5px rgba(66, 153, 225, 0.5);
            transform: translateY(-2px);
        }

        /* Animasi untuk button */
        .button-animation {
            transition: all 0.3s ease;
        }

        .button-animation:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Animasi untuk status alert */
        .status-animation {
            animation: slideDown 0.5s ease-in-out forwards;
            transform: translateY(-20px);
            opacity: 0;
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Animasi error shake */
        .shake-animation {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    </style>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 fade-in" style="animation-delay: 0.1s;">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 status-animation" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="fade-in" style="animation-delay: 0.3s;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full input-animation" type="email" name="email" :value="old('email')" required autofocus
                          oninvalid="this.parentNode.classList.add('shake-animation');" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 shake-animation" />
        </div>

        <div class="flex items-center justify-end mt-4 fade-in" style="animation-delay: 0.5s;">
            <x-primary-button class="button-animation">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript untuk menambahkan interaktivitas -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen form
            const form = document.querySelector('form');
            const emailInput = document.getElementById('email');
            const submitButton = document.querySelector('x-primary-button');

            // Tambahkan animasi ketika form disubmit
            if (form) {
                form.addEventListener('submit', function(event) {
                    // Validasi email secara manual
                    if (!emailInput.value.includes('@')) {
                        event.preventDefault();
                        emailInput.parentNode.classList.add('shake-animation');
                        // Hapus animasi setelah selesai
                        setTimeout(() => {
                            emailInput.parentNode.classList.remove('shake-animation');
                        }, 500);
                    } else {
                        // Animasi loading pada tombol
                        if (submitButton) {
                            submitButton.classList.add('opacity-75');
                            submitButton.innerHTML = '<svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengirim...';
                        }
                    }
                });
            }

            // Menghapus animasi shake setelah input berubah
            if (emailInput) {
                emailInput.addEventListener('input', function() {
                    emailInput.parentNode.classList.remove('shake-animation');
                });
            }
        });
    </script>
</x-guest-layout>
