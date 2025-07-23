{{-- resources/views/foodplace/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <h1 class="text-3xl font-bold text-center mb-8">Daftar Tempat Makanan</h1>

    {{-- Search and Filter Section --}}
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 mb-8">
        <form action="{{ route('food-places.index') }}" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <div class="flex-grow relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kuliner atau lokasi..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">
            </div>
            <div class="md:w-1/4 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <select name="category" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent appearance-none transition-all duration-300">
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
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </div>
        </form>
        
        {{-- Search Results Info --}}
        @if (request()->has('search') || request()->has('category'))
            <div class="mt-4 pt-4 border-t border-gray-200">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($foodPlaces as $place)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1 hover:scale-105">
                @if($place->images->count() > 0)
                    <img src="{{ asset('storage/' . $place->images->first()->image_path) }}" alt="{{ $place->title }}" class="w-full aspect-video object-cover rounded-t-lg">
                @else
                    <div class="aspect-video w-full bg-gray-200 flex items-center justify-center rounded-t-lg">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                <div class="p-4 flex flex-col justify-between flex-grow">
                    <div class="mb-3">
                        <div class="flex items-center mb-2">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-2 py-1 rounded">
                                {{ $place->category ? $place->category->name : '-' }}
                            </span>
                            <div class="flex items-center ml-auto text-sm text-gray-600">
                                <svg class="h-4 w-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                {{ $place->reviews->count() > 0 ? number_format($place->reviews->avg('rating'), 1) : '0.0' }}
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1 transition-all duration-300 hover:text-orange-600">
                            {{ $place->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">{{ $place->description }}</p>
                    </div>

                    <div class="mt-auto">
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-3">
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $place->location }}
                            </div>
                            <span class="text-orange-500 font-medium">
                                Rp {{ number_format($place->min_price, 0, '', '.') }} - {{ number_format($place->max_price, 0, '', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('food-place.show', $place->id) }}" class="block">
                            <button class="w-full px-4 py-2 bg-orange-100 text-orange-500 text-sm font-semibold rounded hover:bg-orange-200 transition-all duration-300 transform hover:scale-105 active:scale-95">
                                Lihat Detail
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center gap-4 py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xl text-center text-gray-600">Tidak ada data tempat makan tersedia.</p>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    @if(isset($foodPlaces) && method_exists($foodPlaces, 'links'))
        <div class="mt-8 flex justify-center">
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
