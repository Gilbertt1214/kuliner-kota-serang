{{-- resources/views/foodfoodPlace/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section with Back Button -->
        <div class="mb-6 flex items-center">
            <a href="{{ route('food-places.index') }}" class="flex items-center text-orange-500 hover:text-orange-600 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Kembali ke Daftar</span>
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Hero Image Section -->
            <div class="relative">
                @if(isset($foodPlace->image))
                    <img src="{{ $foodPlace->image }}" alt="{{ $foodPlace->title }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                @endif

                <!-- Floating Category & Rating Badge -->
                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                    <span class="bg-orange-500 text-white text-sm font-medium px-3 py-1.5 rounded-full shadow-md">
                        {{$foodPlace->category}}
                    </span>
                    <div class="bg-white bg-opacity-90 text-yellow-500 rounded-full px-3 py-1.5 flex items-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-gray-800 font-medium ml-1">{{$foodPlace->rating}}</span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Title & Price Banner -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2 md:mb-0">{{ $foodPlace->title }}</h1>
                    <div class="bg-orange-100 text-orange-600 font-bold px-4 py-2 rounded-lg">
                        Rp {{ number_format($foodPlace->min_price, 0, '', '.') }} - {{ number_format($foodPlace->max_price, 0, '', '.') }}
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-700 mb-3">Deskripsi</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $foodPlace->description }}</p>
                </div>

                <!-- Location Information -->
                @if(isset($foodPlace->location))
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-700 mb-3">Lokasi</h2>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mt-1 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-600">{{ $foodPlace->location }}</span>
                    </div>
                </div>
                @endif

                <!-- Menu Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-700 mb-3">Menu</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <img src="{{$foodPlace->menu }}" alt="Menu" class="w-full rounded-lg shadow-sm"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Peta Lokasi</h2>
            <div class="rounded-lg overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.109966341545!2d106.15535497461251!3d-6.115896093870708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e418b68185750fb%3A0x4d3e2dfae1423ce8!2s527%20coffee!5e0!3m2!1sid!2sid!4v1744725269835!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
