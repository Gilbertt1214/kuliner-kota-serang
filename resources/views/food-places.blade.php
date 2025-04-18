{{-- resources/views/foodplace/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 pt-20">
    <h1 class="text-3xl font-bold text-center mb-8">Daftar Tempat Makanan</h1>

    {{-- Grid Card untuk setiap Food Place --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($foodPlaces as $place)
            {{-- DUmmy --}}
             <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                @if(isset($place->image))
                    <img src="{{ $place->image }}" alt="Warung Nasi Padang" class="w-full h-48 object-cover">
                @else
                    <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif
                <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="bg-orange-100 text-orange-500 text-xs font-medium px-2 py-1 rounded">{{$place->category}}</span>
                            <div class="flex items-center ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-gray-600 text-sm ml-1">{{$place->rating}}</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{$place->title}}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $place->description }}</p>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $place->location }}
                            </span>
                            <span class="text-orange-500 font-medium">Rp {{ number_format($place->min_price, 0, '', '.') }} - {{ number_format($place->max_price, 0, '', '.') }}
                        </span>
                    </div>
                    <a href="{{ route('food-place.show', $place->id) }}" class="text-orange-500 hover:text-orange-700 font-semibold w-full text-center mt-4">
                        <button class="px-4 py-2 bg-orange-100 text-orange-500 rounded hover:bg-orange-200 transition duration-300 w-full mt-4">
                            Lihat Detail
                        </button>
                    </a>
                    </div>
                </div>
        @empty
            <p class="col-span-full text-center text-gray-600">Tidak ada data food place tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
