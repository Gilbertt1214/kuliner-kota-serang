@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Dashboard Pengusaha Kuliner</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Jumlah Pengunjung -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-gray-700">Jumlah Pengunjung</h2>
            {{-- <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $visitors }}</p> --}}
        </div>

        <!-- Jumlah Ulasan -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-gray-700">Jumlah Ulasan</h2>
            {{-- <p class="text-3xl font-bold text-green-600 mt-2">{{ $reviews }}</p> --}}
        </div>

        <!-- Rata-rata Rating -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-gray-700">Rata-rata Rating</h2>
            <div class="flex items-center mt-2">
                <p class="text-3xl font-bold text-yellow-500">{{ number_format($rating, 1) }}</p>
                <span class="ml-2 text-yellow-400">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($rating))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
