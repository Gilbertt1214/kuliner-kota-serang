@extends('layouts.admin')

@section('content')
    <!-- Authors table -->
    @component('admin.components.table', [
        'title' => 'Food Places',
        'headers' => ['Name', 'Description', 'Location', 'Rating', 'Menu', 'Actions'],
    ])
        @foreach ($foodPlaces as $foodPlace)
            <tr>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                        <div>
                            <img src="{{ asset('storage/' . $foodPlace->images->first()->image_path) }}"
                                class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl"
                                alt="user1" />
                        </div>
                        <div class="flex flex-col justify-center">
                            <h6 class="mb-0 text-sm leading-normal">{{ $foodPlace->title }}</h6>
                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $foodPlace->location }}</p>
                        </div>
                    </div>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <p class="mb-0 text-xs font-semibold leading-tight">{{ $foodPlace->description }}</p>
                </td>
                <td
                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <span
                        class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                        {{ $foodPlace->location }}
                    </span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $foodPlace->rating }}</span>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <a href="{{ $foodPlace->menu ?? '#' }}" class="text-xs font-semibold leading-tight text-slate-400">Menu</a>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    {{-- <a href="{{ route('admin.food-places.edit', $foodPlace->id) }}"
                        class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                        <a href="{{ route('admin.food-places.destroy', $foodPlace->id) }}"
                        class="text-xs font-semibold leading-tight text-red-400"> Delete </a>
                        --}}
                    <a href="#" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                    <a href="#" class="text-xs font-semibold bg-red-600 px-3 py-2 leading-tight "> Delete </a>
                </td>
            </tr>
        @endforeach
    @endcomponent

    @include('admin.components.footer')
@endsection
