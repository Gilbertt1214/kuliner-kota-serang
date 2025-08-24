@extends('layouts.admin')

@section('content')
    <div class="container ">
        <!-- Header Section -->
        <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">
                    Manajemen Tempat Kuliner
                </h1>
                <p class="text-gray-600">Monitor dan kelola semua tempat kuliner dalam sistem Anda</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Places Card -->
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-md">
                        <svg class="w-6 h-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500 truncate">
                            Total Tempat
                        </p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $foodPlaces->total() }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Places Card -->
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-md">
                        <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500 truncate">
                            Tempat Aktif
                        </p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $foodPlaces->where('status', 'active')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Approval Card -->
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-yellow-100 rounded-md">
                        <svg class="w-6 h-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500 truncate">
                            Menunggu Persetujuan
                        </p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $foodPlaces->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Inactive Places Card -->
            <div class="p-6 bg-white rounded-lg shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-red-100 rounded-md">
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500 truncate">
                            Tempat Tidak Aktif
                        </p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $foodPlaces->where('status', 'inactive')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="p-6 mb-8 bg-white rounded-lg shadow">
            <div class="flex flex-col space-y-4 md:flex-row md:items-center md:justify-between md:space-y-0">
                <!-- Search Bar -->
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                        class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Cari tempat kuliner...">
                </div>

                <!-- Filters -->
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <select name="category" id="categoryFilter"
                        class="block w-full py-2 pl-3 pr-10 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="rating" id="ratingFilter"
                        class="block w-full py-2 pl-3 pr-10 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                        <option value="4+" {{ request('rating') == '4+' ? 'selected' : '' }}>4+ Bintang</option>
                        <option value="3+" {{ request('rating') == '3+' ? 'selected' : '' }}>3+ Bintang</option>
                    </select>

                    <select name="status" id="statusFilter"
                        class="block w-full py-2 pl-3 pr-10 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <button type="button" id="resetFilterBtn"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2 -ml-1 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Food Places Table -->
        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Daftar Tempat Kuliner</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama
                            </th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Kategori</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Pemilik</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Lokasi</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Rating</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($foodPlaces as $foodPlace)
                            <tr class="transition-colors duration-150 food-place-row hover:bg-gray-50"
                                data-category="{{ $foodPlace->food_category_id }}"
                                data-rating="{{ $foodPlace->reviews->avg('rating') ?? 0 }}"
                                data-status="{{ $foodPlace->status }}">
                                {{-- Name + Image --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            @if ($foodPlace->images->count() > 0)
                                                <img class="object-cover w-10 h-10 rounded-lg"
                                                    src="{{ $foodPlace->images->first()->image_url }}"
                                                    alt="Food Image">
                                            @else
                                                <div
                                                    class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6 text-gray-400">
                                                        <path fill-rule="evenodd"
                                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $foodPlace->title }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1">
                                                {{ Str::limit($foodPlace->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium text-indigo-800 bg-indigo-100 rounded-full">
                                        {{ $foodPlace->category->name ?? 'No Category' }}
                                    </span>
                                </td>

                                {{-- Owner --}}
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                    {{ $foodPlace->user->name ?? 'Unknown' }}
                                </td>

                                {{-- Location --}}
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="line-clamp-1">{{ Str::limit($foodPlace->location, 30) }}</span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-gray-100 text-gray-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusText = [
                                            'pending' => 'Menunggu Review',
                                            'active' => 'Aktif',
                                            'inactive' => 'Tidak Aktif',
                                            'rejected' => 'Ditolak',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClasses[$foodPlace->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statusText[$foodPlace->status] ?? ucfirst($foodPlace->status) }}
                                    </span>
                                </td>

                                {{-- Rating --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        @php $rating = round($foodPlace->reviews->avg('rating') ?? 0); @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="h-4 w-4 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span
                                            class="ml-1 text-xs text-gray-500">({{ $foodPlace->reviews->count() }})</span>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                    <div class="flex justify-center space-x-1">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.food-places.show', $foodPlace->id) }}"
                                            class="p-1 text-indigo-600 transition-colors hover:text-indigo-900"
                                            title="View">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <!-- Edit Button -->
                                        {{-- <a href="{{ route('admin.food-places.edit', $foodPlace->id) }}"
                                            class="p-1 text-yellow-600 transition-colors hover:text-yellow-900"
                                            title="Edit">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a> --}}

                                        @if ($foodPlace->status === 'pending')
                                            <!-- Approve Button -->
                                            <button type="button"
                                                class="p-1 text-green-600 transition-colors hover:text-green-900 approve-btn"
                                                title="Approve" data-id="{{ $foodPlace->id }}"
                                                data-action="{{ route('admin.food-places.approve', $foodPlace->id) }}">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>

                                            <!-- Reject Button -->
                                            <button type="button"
                                                class="p-1 text-red-600 transition-colors hover:text-red-900 reject-btn"
                                                title="Reject" data-id="{{ $foodPlace->id }}"
                                                data-action="{{ route('admin.food-places.reject', $foodPlace->id) }}">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        @endif

                                        <!-- Delete Button -->
                                        <button type="button"
                                            class="p-1 text-red-600 transition-colors hover:text-red-900 delete-btn"
                                            title="Delete" data-id="{{ $foodPlace->id }}"
                                            data-name="{{ $foodPlace->title }}"
                                            data-action="{{ route('admin.food-places.destroy', $foodPlace->id) }}">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <h3 class="mb-2 text-lg font-medium text-gray-900">Tidak ada tempat kuliner ditemukan</h3>
                                        <p class="text-gray-500">Belum ada tempat kuliner yang terdaftar dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($foodPlaces->hasPages())
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $foodPlaces->links() }}
                </div>
            @endif
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Hapus Tempat Kuliner: <span id="deleteItemName" class="font-semibold"></span>
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin menghapus tempat kuliner ini? Tindakan ini tidak dapat
                                        dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form id="deleteForm" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Hapus
                            </button>
                        </form>
                        <button type="button" id="cancelDelete"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed z-50 hidden top-4 right-4">
        <div class="max-w-md p-4 bg-white border border-gray-300 rounded-lg shadow-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div id="toastIcon" class="w-6 h-6"></div>
                </div>
                <div class="flex-1 w-0 ml-3">
                    <p id="toastMessage" class="text-sm font-medium text-gray-900"></p>
                </div>
                <div class="flex flex-shrink-0 ml-4">
                    <button id="toastClose" class="inline-flex text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter elements
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const ratingFilter = document.getElementById('ratingFilter');
            const statusFilter = document.getElementById('statusFilter');
            const resetFilterBtn = document.getElementById('resetFilterBtn');
            const foodPlaceRows = document.querySelectorAll('.food-place-row');

            // Modal and button elements
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const deleteItemName = document.getElementById('deleteItemName');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const cancelDelete = document.getElementById('cancelDelete');
            const approveButtons = document.querySelectorAll('.approve-btn');
            const rejectButtons = document.querySelectorAll('.reject-btn');

            // Search and filter functionality
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const categoryValue = categoryFilter.value;
                const ratingValue = ratingFilter.value;
                const statusValue = statusFilter.value;

                let visibleCount = 0;

                foodPlaceRows.forEach(row => {
                    let showRow = true;

                    // Get row data
                    const nameElement = row.querySelector('.text-sm.font-medium.text-gray-900');
                    const descriptionElement = row.querySelector('.text-sm.text-gray-500.line-clamp-1');
                    const ownerElement = row.querySelector('td:nth-child(3)');
                    const locationElement = row.querySelector('td:nth-child(4) span');

                    const name = nameElement ? nameElement.textContent.toLowerCase() : '';
                    const description = descriptionElement ? descriptionElement.textContent.toLowerCase() : '';
                    const owner = ownerElement ? ownerElement.textContent.toLowerCase() : '';
                    const location = locationElement ? locationElement.textContent.toLowerCase() : '';

                    const category = row.dataset.category;
                    const rating = parseFloat(row.dataset.rating) || 0;
                    const status = row.dataset.status;

                    // Search filter
                    if (searchTerm) {
                        const searchableText = `${name} ${description} ${owner} ${location}`;
                        if (!searchableText.includes(searchTerm)) {
                            showRow = false;
                        }
                    }

                    // Category filter
                    if (categoryValue && category !== categoryValue) {
                        showRow = false;
                    }

                    // Rating filter
                    if (ratingValue) {
                        if (ratingValue === '5' && rating < 5) {
                            showRow = false;
                        } else if (ratingValue === '4+' && rating < 4) {
                            showRow = false;
                        } else if (ratingValue === '3+' && rating < 3) {
                            showRow = false;
                        }
                    }

                    // Status filter
                    if (statusValue && status !== statusValue) {
                        showRow = false;
                    }

                    // Show/hide row
                    row.style.display = showRow ? '' : 'none';
                    if (showRow) visibleCount++;
                });

                // Update results info
                updateResultsInfo(visibleCount);
            }

            function updateResultsInfo(visibleCount) {
                const totalCount = foodPlaceRows.length;
                const tableHeader = document.querySelector('.bg-white.shadow.rounded-lg .px-6.py-4.border-b h3');

                if (tableHeader) {
                    tableHeader.textContent = `Daftar Tempat Kuliner (${visibleCount} dari ${totalCount})`;
                }

                // Show/hide no results message
                showNoResultsMessage(visibleCount);
            }

            function showNoResultsMessage(visibleCount) {
                const tbody = document.querySelector('tbody');
                let noResultsRow = document.getElementById('no-results-row');

                if (visibleCount === 0 && foodPlaceRows.length > 0) {
                    if (!noResultsRow) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.id = 'no-results-row';
                        noResultsRow.innerHTML = `
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <h3 class="mb-2 text-lg font-medium text-gray-900">Tidak ada hasil ditemukan</h3>
                                    <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian Anda</p>
                                    <button onclick="resetFilters()" class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset Filter
                                    </button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(noResultsRow);
                    }
                    noResultsRow.style.display = '';
                } else if (noResultsRow) {
                    noResultsRow.style.display = 'none';
                }
            }

            // Reset filters function (make it global)
            window.resetFilters = function() {
                searchInput.value = '';
                categoryFilter.value = '';
                ratingFilter.value = '';
                statusFilter.value = '';
                filterTable();

                // Update URL
                const url = new URL(window.location);
                url.search = '';
                window.history.pushState({}, '', url);
            }

            // Debounce function for search input
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Event listeners for filters
            searchInput.addEventListener('input', debounce(filterTable, 300));
            categoryFilter.addEventListener('change', filterTable);
            ratingFilter.addEventListener('change', filterTable);
            statusFilter.addEventListener('change', filterTable);
            resetFilterBtn.addEventListener('click', resetFilters);

            // Initialize filters from URL parameters
            function initFiltersFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);

                if (urlParams.has('search')) {
                    searchInput.value = urlParams.get('search');
                }
                if (urlParams.has('category')) {
                    categoryFilter.value = urlParams.get('category');
                }
                if (urlParams.has('rating')) {
                    ratingFilter.value = urlParams.get('rating');
                }
                if (urlParams.has('status')) {
                    statusFilter.value = urlParams.get('status');
                }

                filterTable();
            }

            // Update URL when filters change
            function updateUrlParams() {
                const url = new URL(window.location);

                if (searchInput.value) {
                    url.searchParams.set('search', searchInput.value);
                } else {
                    url.searchParams.delete('search');
                }

                if (categoryFilter.value) {
                    url.searchParams.set('category', categoryFilter.value);
                } else {
                    url.searchParams.delete('category');
                }

                if (ratingFilter.value) {
                    url.searchParams.set('rating', ratingFilter.value);
                } else {
                    url.searchParams.delete('rating');
                }

                if (statusFilter.value) {
                    url.searchParams.set('status', statusFilter.value);
                } else {
                    url.searchParams.delete('status');
                }

                window.history.pushState({}, '', url);
            }

            // Add URL update to filter events
            searchInput.addEventListener('input', debounce(updateUrlParams, 500));
            categoryFilter.addEventListener('change', updateUrlParams);
            ratingFilter.addEventListener('change', updateUrlParams);
            statusFilter.addEventListener('change', updateUrlParams);

            // Delete Modal Functionality
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    const itemName = this.getAttribute('data-name');
                    const actionUrl = this.getAttribute('data-action');

                    deleteItemName.textContent = itemName;
                    deleteForm.action = actionUrl;
                    deleteModal.classList.remove('hidden');
                });
            });

            cancelDelete.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });

            // Approve/Reject Functionality
            approveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    const actionUrl = this.getAttribute('data-action');

                    if (confirm('Apakah Anda yakin ingin menyetujui tempat kuliner ini?')) {
                        fetch(actionUrl, {
                                method: 'PATCH',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showToast('Tempat kuliner berhasil disetujui!', 'success');
                                    setTimeout(() => location.reload(), 1500);
                                } else {
                                    showToast('Gagal menyetujui tempat kuliner.', 'error');
                                }
                            })
                            .catch(error => {
                                showToast('Gagal menyetujui tempat kuliner.', 'error');
                            });
                    }
                });
            });

            rejectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    const actionUrl = this.getAttribute('data-action');

                    if (confirm('Apakah Anda yakin ingin menolak tempat kuliner ini?')) {
                        fetch(actionUrl, {
                                method: 'PATCH',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showToast('Tempat kuliner berhasil ditolak!', 'success');
                                    setTimeout(() => location.reload(), 1500);
                                } else {
                                    showToast('Gagal menolak tempat kuliner.', 'error');
                                }
                            })
                            .catch(error => {
                                showToast('Gagal menolak tempat kuliner.', 'error');
                            });
                    }
                });
            });

            // Toast notification function
            function showToast(message, type) {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');
                const toastIcon = document.getElementById('toastIcon');

                toastMessage.textContent = message;

                if (type === 'success') {
                    toastIcon.innerHTML = `
                        <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>`;
                } else {
                    toastIcon.innerHTML = `
                        <svg class="w-6 h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>`;
                }

                toast.classList.remove('hidden');

                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 4000);
            }

            // Toast close button
            document.getElementById('toastClose').addEventListener('click', function() {
                document.getElementById('toast').classList.add('hidden');
            });

            // Initialize
            initFiltersFromUrl();
        });
    </script>
@endsection
