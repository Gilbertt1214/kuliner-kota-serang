{{-- resources/views/foodplace/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container px-4 py-8 pt-20 mx-auto">
    <h1 class="mb-8 text-3xl font-bold text-center">Daftar Tempat Makanan</h1>

    {{-- Search and Filter Section --}}
    <div class="max-w-4xl p-6 mx-auto mb-8 bg-white shadow-lg rounded-xl">
        <form action="{{ route('food-places.index') }}" method="GET" class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
            <div class="relative flex-grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kuliner atau lokasi..."
                    class="w-full py-3 pl-10 pr-4 transition-all duration-300 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
            <div class="relative md:w-1/4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <select name="category" class="w-full py-3 pl-10 pr-4 transition-all duration-300 border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @if(isset($categories))
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <button type="submit" class="flex items-center justify-center w-full px-6 py-3 font-medium text-white transition-all duration-300 transform bg-orange-500 rounded-lg shadow-md md:w-auto hover:bg-orange-600 hover:-translate-y-1 hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </div>
        </form>
        
        {{-- Search Results Info --}}
        @if (request()->has('search') || request()->has('category'))
            <div class="pt-4 mt-4 border-t border-gray-200">
                <p class="text-gray-600">
                    Ditemukan {{ $foodPlaces->total() }} hasil
                    @if (request('search'))
                        untuk "<span class="font-semibold">{{ request('search') }}</span>"
                    @endif
                    @if (request('category'))
                        @php
                            $selectedCategory = $categories->find(request('category'));
                        @endphp
                        @if ($selectedCategory)
                            dalam kategori "<span class="font-semibold">{{ $selectedCategory->name }}</span>"
                        @endif
                    @endif
                </p>
            </div>
        @endif
    </div>
   
    

    {{-- Grid Card --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @forelse($foodPlaces as $place)
         
            <div class="flex flex-col h-full transition-all duration-300 transform bg-white rounded-lg shadow hover:shadow-lg hover:-translate-y-1 hover:scale-105">
                @if($place->images->count() > 0)
                    <img src="{{ $place->images->first()->image_url }}" alt="{{ $place->title }}" class="object-cover w-full rounded-t-lg aspect-video">
                @else
                    <div class="flex items-center justify-center w-full bg-gray-200 rounded-t-lg aspect-video">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                <div class="flex flex-col justify-between flex-grow p-4">
                    <div class="mb-3">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 text-xs font-medium text-orange-500 bg-orange-100 rounded">
                                {{ $place->category ? $place->category->name : '-' }}
                            </span>
                            <div class="flex items-center ml-auto text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                {{ $place->reviews->count() > 0 ? number_format($place->reviews->avg('rating'), 1) : '0.0' }}
                            </div>
                        </div>
                        <h3 class="mb-1 text-lg font-semibold text-gray-800 transition-all duration-300 hover:text-orange-600">
                            {{ $place->title }}
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ $place->description }}</p>
                    </div>

                    <div class="mt-auto">
                        <div class="flex items-center justify-between mb-3 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $place->location }}
                            </div>
                            <span class="font-medium text-orange-500">
                                Rp {{ number_format($place->min_price, 0, '', '.') }} - {{ number_format($place->max_price, 0, '', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('food-place.show', $place->id) }}" class="block">
                            <button class="w-full px-4 py-2 text-sm font-semibold text-orange-500 transition-all duration-300 transform bg-orange-100 rounded hover:bg-orange-200 hover:scale-105 active:scale-95">
                                Lihat Detail
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center gap-4 py-12 col-span-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xl text-center text-gray-600">Tidak ada data tempat makan tersedia.</p>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    @if(isset($foodPlaces) && method_exists($foodPlaces, 'links'))
        <div class="flex justify-center mt-8">
            {{ $foodPlaces->links() }}
        </div>
    @endif
</div>

<!-- Add CSS for animations -->
<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
