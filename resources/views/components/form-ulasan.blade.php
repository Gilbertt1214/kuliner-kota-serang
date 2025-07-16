{{-- resources/views/foodPlace/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 pt-20">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section with Back Button - Enhanced Animation -->
            <!-- ... (keep your existing header code) ... -->
            <!-- Main Content Card - Added Entrance Animation -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:shadow-xl animate-fade-in-up">
            </div>
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6 transition-all duration-500 hover:shadow-xl animate-fade-in-up delay-100">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Ulasan Pengunjung
                </h2>
                <!-- Review Form (only for authenticated users) -->
                @if (auth()->check())
                <div class="mb-8 p-6 bg-orange-50 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Tulis Ulasan Anda</h3>
                    <form action="{{ route('review.store', $foodPlace->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating:</label>
                            <div class="flex items-center">
                                <div class="rating-stars flex space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="hidden" {{ $i == 3 ? 'checked' : '' }}>
                                        <label for="star{{$i}}" class="star-label cursor-pointer transition-all duration-300 transform hover:scale-125">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                <span id="rating-value" class="ml-2 text-sm text-gray-600 font-medium transition-all duration-300">3 bintang</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Komentar:</label>
                            <textarea name="comment" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all duration-300 hover:shadow-md" placeholder="Bagikan pengalaman Anda..."></textarea>
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-300 transform hover:scale-105 active:scale-95">
                            Kirim Ulasan
                        </button>
                    </form>
                </div>
                @else
                <div class="mb-6 p-4 bg-gray-50 rounded-lg text-center">
                    <p class="text-gray-600">Anda perlu <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-medium transition-colors duration-300">login</a> untuk menulis ulasan.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-stars input');
            const ratingValue = document.getElementById('rating-value');
            const starLabels = document.querySelectorAll('.star-label');

            // Initialize with default selected value (3 stars)
            updateStars(3);

            stars.forEach(star => {
                star.addEventListener('change', function() {
                    const value = this.value;
                    updateStars(value);
                });

                // Hover effect
                star.addEventListener('mouseenter', function() {
                    const hoverValue = this.value;
                    starLabels.forEach((label, index) => {
                        const starSvg = label.querySelector('svg');
                        if (index < hoverValue) {
                            starSvg.classList.add('text-orange-300');
                            starSvg.classList.remove('text-gray-400');
                        } else {
                            starSvg.classList.add('text-gray-400');
                            starSvg.classList.remove('text-orange-300');
                        }
                    });
                });

                star.addEventListener('mouseleave', function() {
                    const selectedValue = document.querySelector('.rating-stars input:checked').value;
                    updateStars(selectedValue);
                });
            });

            function updateStars(value) {
                ratingValue.textContent = value + ' bintang';
                ratingValue.classList.add('animate-pulse');

                // Remove animation after it completes
                setTimeout(() => {
                    ratingValue.classList.remove('animate-pulse');
                }, 300);

                starLabels.forEach((label, index) => {
                    const starSvg = label.querySelector('svg');

                    // Bounce animation for the selected star
                    if (index < value) {
                        starSvg.classList.add('text-orange-500');
                        starSvg.classList.remove('text-gray-400', 'text-orange-300');

                        // Add bounce effect to newly selected stars
                        if (index === value - 1) {
                            label.classList.add('animate-bounce');
                            setTimeout(() => {
                                label.classList.remove('animate-bounce');
                            }, 1000);
                        }
                    } else {
                        starSvg.classList.add('text-gray-400');
                        starSvg.classList.remove('text-orange-500', 'text-orange-300');
                    }
                });
            }
        });
    </script>

    <style>
        @keyframes bounce {
            0%, 100% {
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
    </style>
@endsection
