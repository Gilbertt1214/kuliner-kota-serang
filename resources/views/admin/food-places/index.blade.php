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
            <button id="openModalBtn"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
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
                        <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500 truncate">Total Places</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $foodPlaces->total() }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Places Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500 truncate">Active Places</p>
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ $foodPlaces->where('status', 'active')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Food Place Modal -->
        <div id="foodPlaceModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal positioning -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Content -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <!-- Modal Header -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Food Place</h3>
                            <button type="button" id="closeModalBtn" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Error Alert -->
                        <div id="errorAlert" class="hidden mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <div class="flex">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span id="errorMessage">Please correct the errors below.</span>
                            </div>
                        </div>

                        <!-- Form -->
                        <form id="foodPlaceForm" action="{{ route('admin.food-places.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div class="col-span-2">
                                    <label for="title" class="block text-sm font-medium text-gray-700">
                                        Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Enter food place name">
                                    <div id="title-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="food_category_id" class="block text-sm font-medium text-gray-700">
                                        Category <span class="text-red-500">*</span>
                                    </label>
                                    <select name="food_category_id" id="food_category_id" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('food_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="food_category_id-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div id="status-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Min Price -->
                                <div>
                                    <label for="min_price" class="block text-sm font-medium text-gray-700">
                                        Min Price (IDR) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="min_price" id="min_price" min="0" step="1000"
                                        value="{{ old('min_price') }}" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="e.g., 15000">
                                    <div id="min_price-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Max Price -->
                                <div>
                                    <label for="max_price" class="block text-sm font-medium text-gray-700">
                                        Max Price (IDR) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="max_price" id="max_price" min="0" step="1000"
                                        value="{{ old('max_price') }}" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="e.g., 50000">
                                    <div id="max_price-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Location -->
                                <div class="col-span-2">
                                    <label for="location" class="block text-sm font-medium text-gray-700">
                                        Location <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="location" id="location" value="{{ old('location') }}" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Enter full address">
                                    <div id="location-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Source Location -->
                                <div class="col-span-2">
                                    <label for="source_location" class="block text-sm font-medium text-gray-700">
                                        Source Location (URL)
                                    </label>
                                    <input type="url" name="source_location" id="source_location" value="{{ old('source_location') }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="https://maps.google.com/...">
                                    <div id="source_location-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Description -->
                                <div class="col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700">
                                        Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="description" id="description" rows="3" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Describe the food place, atmosphere, specialties, etc.">{{ old('description') }}</textarea>
                                    <div id="description-error" class="hidden mt-1 text-sm text-red-600"></div>
                                </div>

                                <!-- Images -->
                                <div class="col-span-2">
                                    <label for="images" class="block text-sm font-medium text-gray-700">
                                        Images (Max 5) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="images[]" id="images" multiple accept="image/*" required
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <div id="images-error" class="hidden mt-1 text-sm text-red-600"></div>

                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="mt-3 grid grid-cols-2 md:grid-cols-5 gap-2 hidden"></div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Supported formats: JPEG, PNG, JPG. Max size: 2MB per image
                                    </p>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button" id="cancelFormBtn"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </button>
                                <button type="submit" id="submitBtn"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg id="spinner" class="hidden -ml-1 mr-3 h-5 w-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span id="submitText">Save Food Place</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Notification -->
        <div id="successNotification" class="fixed top-4 right-4 hidden z-50">
            <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center animate-bounce">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span id="successMessage">Food place added successfully!</span>
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
                    <input type="text" id="searchInput"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Search food places...">
                </div>

                <!-- Filters -->
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                    <select name="category" id="categoryFilter"
                        class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="rating" id="ratingFilter"
                        class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                        <option value="4+" {{ request('rating') == '4+' ? 'selected' : '' }}>4+ Stars</option>
                        <option value="3+" {{ request('rating') == '3+' ? 'selected' : '' }}>3+ Stars</option>
                    </select>

                    <select name="status" id="statusFilter"
                        class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    <button type="button" id="resetFilterBtn"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($foodPlaces as $foodPlace)
                            <tr class="food-place-row hover:bg-gray-50 transition-colors duration-150"
                                data-category="{{ $foodPlace->food_category_id }}"
                                data-rating="{{ $foodPlace->reviews->avg('rating') ?? 0 }}"
                                data-status="{{ $foodPlace->status }}">
                                {{-- Name + Image --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if ($foodPlace->images->count() > 0)
                                                <img class="h-10 w-10 rounded-lg object-cover"
                                                    src="{{ asset('storage/' . $foodPlace->images->first()->image_path) }}"
                                                    alt="Food Image">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $foodPlace->title }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1">{{ Str::limit($foodPlace->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $foodPlace->category->name ?? 'No Category' }}
                                    </span>
                                </td>

                                {{-- Owner --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $foodPlace->user->name ?? 'Unknown' }}
                                </td>

                                {{-- Location --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="line-clamp-1">{{ Str::limit($foodPlace->location, 30) }}</span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $foodPlace->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($foodPlace->status) }}
                                    </span>
                                </td>

                                {{-- Rating --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        @php $rating = round($foodPlace->reviews->avg('rating') ?? 0); @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="h-4 w-4 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span class="ml-1 text-xs text-gray-500">({{ $foodPlace->reviews->count() }})</span>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.food-places.show', $foodPlace->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition-colors" title="View">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.food-places.edit', $foodPlace->id) }}"
                                            class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                            class="text-red-600 hover:text-red-900 transition-colors delete-btn"
                                            title="Delete"
                                            data-id="{{ $foodPlace->id }}"
                                            data-name="{{ $foodPlace->title }}">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="h-12 w-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No food places found</h3>
                                        <p class="text-gray-500">Get started by adding your first food place.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($foodPlaces->hasPages())
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $foodPlaces->links() }}
                </div>
            @endif
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Food Place</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete "<span id="deleteName" class="font-medium"></span>"? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" id="confirmDelete"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                        <button type="button" id="cancelDelete"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Elements
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('foodPlaceModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelFormBtn = document.getElementById('cancelFormBtn');
    const form = document.getElementById('foodPlaceForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const spinner = document.getElementById('spinner');
    const successNotification = document.getElementById('successNotification');
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('imagePreview');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');

    // Delete Modal Elements
    const deleteModal = document.getElementById('deleteModal');
    const deleteName = document.getElementById('deleteName');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelDelete = document.getElementById('cancelDelete');
    let deleteFormAction = '';

    // Modal Functions
    function openModal() {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        resetForm();
    }

    function showErrorAlert(message) {
        errorMessage.textContent = message;
        errorAlert.classList.remove('hidden');
    }

    function hideErrorAlert() {
        errorAlert.classList.add('hidden');
    }

    function showSuccessNotification(message) {
        document.getElementById('successMessage').textContent = message;
        successNotification.classList.remove('hidden');
        setTimeout(() => {
            successNotification.classList.add('hidden');
        }, 5000);
    }

    // Event Listeners
    openModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);
    cancelFormBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Image Preview Functionality
    imageInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        imagePreview.innerHTML = '';

        if (files.length > 5) {
            showError('images', 'Maximum 5 images allowed');
            e.target.value = '';
            return;
        }

        if (files.length > 0) {
            imagePreview.classList.remove('hidden');
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    if (file.size > 2 * 1024 * 1024) { // 2MB limit
                        showError('images', `Image ${file.name} is too large. Maximum size is 2MB.`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-24 object-cover rounded-md border">
                            <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity remove-image" data-index="${index}">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="absolute bottom-1 left-1 bg-black bg-opacity-50 text-white text-xs px-1 rounded">${index + 1}</div>
                        `;
                        imagePreview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            imagePreview.classList.add('hidden');
        }
    });

    // Remove image functionality
    imagePreview.addEventListener('click', function(e) {
        if (e.target.closest('.remove-image')) {
            const index = parseInt(e.target.closest('.remove-image').dataset.index);
            removeImage(index);
        }
    });

    function removeImage(index) {
        const dt = new DataTransfer();
        const files = Array.from(imageInput.files);

        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });

        imageInput.files = dt.files;
        imageInput.dispatchEvent(new Event('change'));
    }

    // Form Validation
    function validateForm() {
        let isValid = true;
        hideErrorAlert();
        clearAllErrors();

        // Required field validation
        const requiredFields = [
            { id: 'title', name: 'Food place name' },
            { id: 'food_category_id', name: 'Category' },
            { id: 'min_price', name: 'Minimum price' },
            { id: 'max_price', name: 'Maximum price' },
            { id: 'location', name: 'Location' },
            { id: 'description', name: 'Description' }
        ];

        requiredFields.forEach(field => {
            const element = document.getElementById(field.id);
            if (!element.value.trim()) {
                showError(field.id, `${field.name} is required`);
                isValid = false;
            }
        });

        // Image validation
        if (imageInput.files.length === 0) {
            showError('images', 'At least one image is required');
            isValid = false;
        }

        // Price validation
        const minPrice = parseFloat(document.getElementById('min_price').value);
        const maxPrice = parseFloat(document.getElementById('max_price').value);

        if (minPrice && maxPrice && minPrice >= maxPrice) {
            showError('max_price', 'Maximum price must be greater than minimum price');
            isValid = false;
        }

        // URL validation
        const sourceLocation = document.getElementById('source_location').value;
        if (sourceLocation && !isValidUrl(sourceLocation)) {
            showError('source_location', 'Please enter a valid URL');
            isValid = false;
        }

        return isValid;
    }

    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    function showError(fieldId, message) {
        const errorDiv = document.getElementById(`${fieldId}-error`);
        const inputElement = document.getElementById(fieldId);

        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
        }

        if (inputElement) {
            inputElement.classList.add('border-red-500');
            inputElement.classList.remove('border-gray-300');
        }
    }

    function hideError(fieldId) {
        const errorDiv = document.getElementById(`${fieldId}-error`);
        const inputElement = document.getElementById(fieldId);

        if (errorDiv) {
            errorDiv.classList.add('hidden');
        }

        if (inputElement) {
            inputElement.classList.remove('border-red-500');
            inputElement.classList.add('border-gray-300');
        }
    }

    function clearAllErrors() {
        document.querySelectorAll('[id$="-error"]').forEach(el => {
            el.classList.add('hidden');
        });

        document.querySelectorAll('input, select, textarea').forEach(el => {
            el.classList.remove('border-red-500');
            el.classList.add('border-gray-300');
        });
    }

    function resetForm() {
        form.reset();
        imagePreview.innerHTML = '';
        imagePreview.classList.add('hidden');
        clearAllErrors();
        hideErrorAlert();
    }

    // Form Submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!validateForm()) {
            showErrorAlert('Please correct the errors below and try again.');
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Saving...';
        spinner.classList.remove('hidden');

        try {
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showSuccessNotification(data.message || 'Food place added successfully!');
                closeModal();

                // Reload page after short delay
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                // Handle validation errors
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        showError(field, data.errors[field][0]);
                    });
                    showErrorAlert('Please correct the errors below and try again.');
                } else {
                    showErrorAlert(data.message || 'An error occurred while saving the food place.');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            showErrorAlert('A network error occurred. Please try again.');
        } finally {
            // Reset loading state
            submitBtn.disabled = false;
            submitText.textContent = 'Save Food Place';
            spinner.classList.add('hidden');
        }
    });

    // Delete Functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            const btn = e.target.closest('.delete-btn');
            const id = btn.dataset.id;
            const name = btn.dataset.name;

            deleteName.textContent = name;
            deleteFormAction = `{{ route('admin.food-places.index') }}/${id}`;
            deleteModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    });

    cancelDelete.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    confirmDelete.addEventListener('click', async function() {
        try {
            const response = await fetch(deleteFormAction, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            });

            const data = await response.json();

            if (response.ok && data.success) {
                deleteModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                showSuccessNotification(data.message || 'Food place deleted successfully!');

                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                alert(data.message || 'An error occurred while deleting the food place.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('A network error occurred. Please try again.');
        }
    });

    // Filter Functionality
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const ratingFilter = document.getElementById('ratingFilter');
    const statusFilter = document.getElementById('statusFilter');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const foodPlaceRows = document.querySelectorAll('.food-place-row');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const categoryValue = categoryFilter.value;
        const ratingValue = ratingFilter.value;
        const statusValue = statusFilter.value;

        let visibleCount = 0;

        foodPlaceRows.forEach(row => {
            const titleElement = row.querySelector('td:first-child .text-gray-900');
            const descriptionElement = row.querySelector('td:first-child .text-gray-500');

            const title = titleElement ? titleElement.textContent.toLowerCase() : '';
            const description = descriptionElement ? descriptionElement.textContent.toLowerCase() : '';
            const category = row.dataset.category;
            const rating = parseFloat(row.dataset.rating) || 0;
            const status = row.dataset.status;

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

            // Status filter
            if (statusValue && status !== statusValue) {
                showRow = false;
            }

            row.style.display = showRow ? '' : 'none';
            if (showRow) visibleCount++;
        });

        // Show/hide no results message
        updateNoResultsMessage(visibleCount);
    }

    function updateNoResultsMessage(visibleCount) {
        const tbody = document.querySelector('tbody');
        let noResultsRow = document.getElementById('no-results-row');

        if (visibleCount === 0 && foodPlaceRows.length > 0) {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'no-results-row';
                noResultsRow.innerHTML = `
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="h-12 w-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No results found</h3>
                            <p class="text-gray-500">Try adjusting your search or filter criteria.</p>
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

    // Filter event listeners
    searchInput.addEventListener('input', filterTable);
    categoryFilter.addEventListener('change', filterTable);
    ratingFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);

    resetFilterBtn.addEventListener('click', function() {
        searchInput.value = '';
        categoryFilter.value = '';
        ratingFilter.value = '';
        statusFilter.value = '';
        filterTable();

        // Update URL without page reload
        const url = new URL(window.location);
        url.search = '';
        window.history.pushState({}, '', url);
    });

    // Initialize filters from URL parameters
    function initFiltersFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);

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

    // Real-time validation
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                showError(this.id, 'This field is required');
            } else {
                hideError(this.id);
            }
        });

        element.addEventListener('input', function() {
            if (this.value.trim()) {
                hideError(this.id);
            }
        });
    });

    // Price validation
    document.getElementById('min_price').addEventListener('input', function() {
        const maxPrice = document.getElementById('max_price').value;
        if (maxPrice && parseFloat(this.value) >= parseFloat(maxPrice)) {
            showError('min_price', 'Minimum price must be less than maximum price');
        } else {
            hideError('min_price');
            hideError('max_price');
        }
    });

    document.getElementById('max_price').addEventListener('input', function() {
        const minPrice = document.getElementById('min_price').value;
        if (minPrice && parseFloat(this.value) <= parseFloat(minPrice)) {
            showError('max_price', 'Maximum price must be greater than minimum price');
        } else {
            hideError('min_price');
            hideError('max_price');
        }
    });

    // Initialize
    initFiltersFromUrl();
});
</script>
@endpush
