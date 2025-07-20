@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-900">Food Places Management</h1>
            <p class="text-gray-600">Manage all food places in your system</p>
        </div>
        <!-- Add New Food Place Button -->
        <button id="openModalBtn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Food Place
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Places Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                    <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Total Places</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $foodPlaces->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Food Place Modal -->
    <div id="foodPlaceModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center border-b pb-3">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            <svg class="h-6 w-6 text-indigo-600 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add New Food Place
                        </h3>
                        <button type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form id="foodPlaceForm" class="mt-4 space-y-4" enctype="multipart/form-data" method="POST" action="{{ route('admin.food-places.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Name -->
                            <div class="col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <p class="mt-1 text-sm text-red-600 hidden" id="title-error"></p>
                            </div>

                            <!-- Category -->
                            <div class="col-span-2 md:col-span-1">
                                <label for="food_category_id" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                                <select name="food_category_id" id="food_category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-sm text-red-600 hidden" id="food_category_id-error"></p>
                            </div>

                            <!-- Price Range -->
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700">Price Range <span class="text-red-500">*</span></label>
                                <div class="mt-1 grid grid-cols-2 gap-2">
                                    <div>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="price_min" id="price_min" class="block w-full pl-12 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Min" required>
                                        </div>
                                        <p class="mt-1 text-sm text-red-600 hidden" id="price_min-error"></p>
                                    </div>
                                    <div>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="price_max" id="price_max" class="block w-full pl-12 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Max" required>
                                        </div>
                                        <p class="mt-1 text-sm text-red-600 hidden" id="price_max-error"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                                <p class="mt-1 text-sm text-red-600 hidden" id="description-error"></p>
                            </div>

                            <!-- Location -->
                            <div class="col-span-2">
                                <label for="location" class="block text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                                <input type="text" name="location" id="location" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <p class="mt-1 text-sm text-red-600 hidden" id="location-error"></p>
                            </div>

                            <!-- Google Maps Link -->
                            <div class="col-span-2">
                                <label for="source_location" class="block text-sm font-medium text-gray-700">Google Maps Link</label>
                                <input type="url" name="source_location" id="source_location" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <p class="mt-1 text-sm text-gray-500">Paste the Google Maps URL for your business location</p>
                                <p class="mt-1 text-sm text-red-600 hidden" id="source_location-error"></p>
                            </div>

                            <!-- Images -->
                            <div class="col-span-2">
                                <label for="images" class="block text-sm font-medium text-gray-700">Images <span class="text-red-500">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload files</span>
                                                <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, JPEG up to 5MB (max 5 images)
                                        </p>
                                    </div>
                                </div>
                                <div id="imagePreview" class="mt-2 grid-cols-3 gap-2 hidden"></div>
                                <p class="mt-1 text-sm text-red-600 hidden" id="images-error"></p>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                            <a ></a>
                            <button type="button" id="cancelBtn" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" id="submitBtn" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span id="submitText">Save</span>
                                <span id="spinner" class="hidden ml-2">
                                    <svg class="animate-spin -ml-1 mr-1 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="successNotification" class="fixed top-4 right-4 hidden">
        <div class="bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center animate-pop-in">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>Food place added successfully!</span>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow mb-8 p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <!-- Search Bar -->
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="searchInput" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search food places...">
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <select name="category" id="categoryFilter" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="rating" id="ratingFilter" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">All Ratings</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                    <option value="4+" {{ request('rating') == '4+' ? 'selected' : '' }}>4+ Stars</option>
                    <option value="3+" {{ request('rating') == '3+' ? 'selected' : '' }}>3+ Stars</option>
                </select>

                <button type="button" id="resetFilterBtn" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Food Places Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Food Places List</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengusaha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Rating</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($foodPlaces as $foodPlace)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    {{-- Name + Image --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if($foodPlace->images->count())
                                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $foodPlace->images->first()->image_path) }}" alt="Food Image">
                                @else
                                    <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <x-heroicon-o-photograph class="h-6 w-6 text-gray-400" />
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $foodPlace->title }}</div>
                                <div class="text-sm text-gray-500 line-clamp-1">{{ $foodPlace->description }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- Category --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                            {{ $foodPlace->category->name ?? 'No Category' }}
                        </span>
                    </td>



                    {{-- Pengusaha --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                       {{ $place->owner->name ?? 'Tidak diketahui' }}
                    </td>

                    {{-- Location --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center">
                            <x-heroicon-o-location-marker class="h-4 w-4 text-gray-400 mr-1" />
                            <span class="line-clamp-1">{{ $foodPlace->location }}</span>
                        </div>
                    </td>

                    {{-- Rating --}}
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center">
                            @php $rating = round($foodPlace->reviews->avg('rating') ?? 0); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-1 text-xs text-gray-500">({{ $foodPlace->reviews->count() }})</span>
                        </div>
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.food-places.show', $foodPlace->id) }}" class="text-indigo-600 hover:text-indigo-900" title="View">
                                <x-heroicon-o-eye class="h-5 w-5" />
                            </a>
                            <a href="{{ route('admin.food-places.edit', $foodPlace->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                <x-heroicon-o-pencil-alt class="h-5 w-5" />
                            </a>
                            <form action="{{ route('admin.food-places.destroy', $foodPlace->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this)" class="text-red-600 hover:text-red-900" title="Delete">
                                    <x-heroicon-o-trash class="h-5 w-5" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No food places found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-3 border-t border-gray-200">
        {{ $foodPlaces->links() }}
    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Elements
        const openModalBtn = document.getElementById('openModalBtn');
        const modal = document.getElementById('foodPlaceModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const form = document.getElementById('foodPlaceForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const spinner = document.getElementById('spinner');
        const successNotification = document.getElementById('successNotification');
        const imageInput = document.getElementById('images');
        const imagePreview = document.getElementById('imagePreview');

        // Open Modal
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        // Close Modal
        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetForm();
        }

        closeModalBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        // Image Preview
        imageInput.addEventListener('change', function(e) {
            const files = e.target.files;
            imagePreview.innerHTML = '';

            if (files.length > 0) {
                imagePreview.classList.remove('hidden');

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="w-full h-24 object-cover rounded-md">
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity" data-index="${i}">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        `;
                        imagePreview.appendChild(div);

                        // Add remove button event
                        div.querySelector('button').addEventListener('click', function() {
                            removeImage(i);
                        });
                    };

                    reader.readAsDataURL(file);
                }
            } else {
                imagePreview.classList.add('hidden');
            }
        });

        // Remove Image
        function removeImage(index) {
            const dt = new DataTransfer();
            const files = imageInput.files;

            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }

            imageInput.files = dt.files;
            imageInput.dispatchEvent(new Event('change'));
        }

        // Form Validation
        function validateForm() {
            let isValid = true;
            const requiredFields = ['title', 'food_category_id', 'price_min', 'price_max', 'description', 'location', 'images'];

            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    showError(field, 'This field is required');
                    isValid = false;
                } else {
                    hideError(field);
                }
            });

            // Validate price range
            const minPrice = parseFloat(document.getElementById('price_min').value);
            const maxPrice = parseFloat(document.getElementById('price_max').value);

            if (minPrice && maxPrice && minPrice > maxPrice) {
                showError('price_max', 'Max price must be greater than min price');
                isValid = false;
            }

            return isValid;
        }

        // Show Error
        function showError(fieldId, message) {
            const errorElement = document.getElementById(`${fieldId}-error`);
            const inputElement = document.getElementById(fieldId);

            if (errorElement) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
            }

            if (inputElement) {
                inputElement.classList.add('border-red-500');
                inputElement.classList.remove('border-gray-300');
            }
        }

        // Hide Error
        function hideError(fieldId) {
            const errorElement = document.getElementById(`${fieldId}-error`);
            const inputElement = document.getElementById(fieldId);

            if (errorElement) {
                errorElement.classList.add('hidden');
            }

            if (inputElement) {
                inputElement.classList.remove('border-red-500');
                inputElement.classList.add('border-gray-300');
            }
        }

        // Reset Form
        function resetForm() {
            form.reset();
            imagePreview.innerHTML = '';
            imagePreview.classList.add('hidden');

            // Hide all error messages
            document.querySelectorAll('[id$="-error"]').forEach(el => {
                el.classList.add('hidden');
            });

            // Reset input styles
            document.querySelectorAll('input, select, textarea').forEach(el => {
                el.classList.remove('border-red-500');
                el.classList.add('border-gray-300');
            });
        }

        // Form Submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Saving...';
            spinner.classList.remove('hidden');

            // Submit form
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    successNotification.classList.remove('hidden');
                    setTimeout(() => {
                        successNotification.classList.add('hidden');
                    }, 3000);

                    // Close modal and reload page
                    closeModal();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            showError(field, data.errors[field][0]);
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                // Reset loading state
                submitBtn.disabled = false;
                submitText.textContent = 'Save';
                spinner.classList.add('hidden');
            });
        });

        // Filter Functionality
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const ratingFilter = document.getElementById('ratingFilter');
        const resetFilterBtn = document.getElementById('resetFilterBtn');
        const foodPlaceRows = document.querySelectorAll('.food-place-row');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const categoryValue = categoryFilter.value;
            const ratingValue = ratingFilter.value;

            foodPlaceRows.forEach(row => {
                const title = row.querySelector('td:nth-child(1) .text-gray-900').textContent.toLowerCase();
                const description = row.querySelector('td:nth-child(1) .text-gray-500').textContent.toLowerCase();
                const category = row.dataset.category;
                const rating = parseFloat(row.dataset.rating);

                let showRow = true;

                // Search filter
                if (searchTerm && !title.includes(searchTerm) && !description.includes(searchTerm)) {
                    showRow = false;
                }

                // Category filter
                if (categoryValue && category !== categoryValue) {
                    showRow = false;
                }

                // Rating filter
                if (ratingValue) {
                    if (ratingValue.endsWith('+')) {
                        const minRating = parseInt(ratingValue);
                        if (rating < minRating) {
                            showRow = false;
                        }
                    } else {
                        if (Math.floor(rating) !== parseInt(ratingValue)) {
                            showRow = false;
                        }
                    }
                }

                row.style.display = showRow ? '' : 'none';
            });
        }

        // Event Listeners for Filters
        searchInput.addEventListener('input', filterTable);
        categoryFilter.addEventListener('change', filterTable);
        ratingFilter.addEventListener('change', filterTable);
        resetFilterBtn.addEventListener('click', function() {
            searchInput.value = '';
            categoryFilter.value = '';
            ratingFilter.value = '';
            filterTable();
        });

        // Confirm Delete
        window.confirmDelete = function(button) {
            if (confirm('Are you sure you want to delete this food place?')) {
                button.closest('form').submit();
            }
        };
    });
</script>
@endpush
@endsection
