@extends('layouts.admin')


@section('content')
    @php
        use Illuminate\Support\Facades\Storage;
    @endphp
    <div class="container ">
        <!-- Header Section -->
        <div class="flex flex-col mb-8 md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">
                    Tempat Kuliner Anda
                </h1>
                <p class="text-gray-600">Kelola tempat kuliner Anda</p>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('pengusaha.food-places.create') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition-colors bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Daftarkan Tempat Kuliner
                </a>
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
                        <p class="text-sm font-medium text-gray-500 truncate">Total Tempat</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
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
                        <p class="text-sm font-medium text-gray-500 truncate">Aktif</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['active'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Pending Places Card -->
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
                        <p class="text-sm font-medium text-gray-500 truncate">Menunggu Persetujuan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Rejected Places Card -->
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
                        <p class="text-sm font-medium text-gray-500 truncate">Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Info -->
        @if ($stats['pending'] > 0)
            <div class="p-4 mb-6 border border-yellow-200 rounded-md bg-yellow-50">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">
                            Ada {{ $stats['pending'] }} tempat kuliner menunggu persetujuan admin
                        </h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Admin akan mereview submission Anda dalam 1-3 hari kerja.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Food Places Table -->
        <div class="overflow-hidden bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Daftar Tempat Kuliner Anda</h3>
            </div>

            @if ($foodPlaces->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Nama</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Kategori</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Rating</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Tanggal Daftar</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($foodPlaces as $foodPlace)
                                <tr class="hover:bg-gray-50">
                                    <!-- Name + Image -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                @if ($foodPlace->images->where('type', 'business')->count() > 0)
                                                    <img class="object-cover w-10 h-10 rounded-lg"
                                                        src="{{ $foodPlace->images->where('type', 'business')->first()->image_url }}"
                                                        alt="{{ $foodPlace->title }}">
                                                @else
                                                    <div
                                                        class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-lg">
                                                        <svg class="w-6 h-6 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $foodPlace->title }}
                                                </div>
                                                <div class="text-sm text-gray-500">Rp
                                                    {{ number_format($foodPlace->min_price) }} -
                                                    {{ number_format($foodPlace->max_price) }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Category -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs font-medium text-indigo-800 bg-indigo-100 rounded-full">
                                            {{ $foodPlace->category->name ?? 'No Category' }}
                                        </span>
                                    </td>

                                    <!-- Status -->
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

                                    <!-- Rating -->
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            @php $rating = round($foodPlace->reviews->avg('rating') ?? 0); @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="h-4 w-4 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                            <span
                                                class="ml-1 text-xs text-gray-500">({{ $foodPlace->reviews->count() }})</span>
                                        </div>
                                    </td>

                                    <!-- Date -->
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $foodPlace->created_at->format('d M Y') }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <!-- View Button -->
                                            <a href="{{ route('pengusaha.food-places.show', $foodPlace->id) }}"
                                                class="text-indigo-600 transition-colors hover:text-indigo-900"
                                                title="Lihat Detail">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            {{-- @if ($foodPlace->status !== 'active') --}}
                                            <!-- Edit Button - Only if not active -->
                                            <a href="{{ route('pengusaha.food-places.edit', $foodPlace->id) }}"
                                                class="text-yellow-600 transition-colors hover:text-yellow-900"
                                                title="Edit">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            {{-- @endif --}}

                                            <!-- Delete Button -->
                                            <button type="button"
                                                class="text-red-600 transition-colors hover:text-red-900 delete-btn"
                                                title="Hapus" data-id="{{ $foodPlace->id }}"
                                                data-name="{{ $foodPlace->title }}"
                                                data-action="{{ route('pengusaha.food-places.destroy', $foodPlace->id) }}">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($foodPlaces->hasPages())
                    <div class="px-6 py-3 border-t border-gray-200">
                        {{ $foodPlaces->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="mb-2 text-lg font-medium text-gray-900">Belum ada tempat kuliner</h3>
                        <p class="mb-4 text-gray-500">Mulai dengan mendaftarkan tempat kuliner pertama Anda.</p>
                        <a href="{{ route('pengusaha.food-places.create') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition-colors bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                            Daftarkan Tempat Kuliner
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
            <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96">
                <div class="mt-3 text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-lg font-medium leading-6 text-gray-900">Hapus Tempat Kuliner</h3>
                    <div class="py-3 mt-2 px-7">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin menghapus "<span id="deleteItemName"></span>"? Tindakan ini tidak dapat
                            dibatalkan.
                        </p>
                    </div>
                    <div class="flex items-center justify-center px-4 py-3 space-x-3">
                        <button id="cancelDelete"
                            class="w-24 px-4 py-2 text-base font-medium text-white transition-colors bg-gray-500 rounded-md hover:bg-gray-600">
                            Batal
                        </button>
                        <form id="deleteForm" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-24 px-4 py-2 text-base font-medium text-white transition-colors bg-red-600 rounded-md hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete Modal Functionality
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const deleteItemName = document.getElementById('deleteItemName');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const cancelDelete = document.getElementById('cancelDelete');

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
        });
    </script>
@endsection
