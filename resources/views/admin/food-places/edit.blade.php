@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">

        <!-- Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Food Place
                </h2>
                <a href="{{ route('admin.food-places.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.food-places.update', $foodPlace->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="title" id="title"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150"
                       value="{{ old('title', $foodPlace->title) }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="food_category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="food_category_id" id="food_category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $foodPlace->food_category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('food_category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price Range -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">Min Price</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="price_min" id="price_min"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150"
                                   value="{{ old('price_min', $foodPlace->min_price) }}" required>
                        </div>
                        @error('price_min')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="price_max" id="price_max"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150"
                                   value="{{ old('price_max', $foodPlace->max_price) }}" required>
                        </div>
                        @error('price_max')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150" required>{{ old('description', $foodPlace->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-6">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location" id="location"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150"
                       value="{{ old('location', $foodPlace->location) }}" required>
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Google Maps Link -->
            <div class="mb-6">
                <label for="source_location" class="block text-sm font-medium text-gray-700 mb-1">Google Maps Link</label>
                <input type="url" name="source_location" id="source_location"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-150"
                       value="{{ old('source_location', $foodPlace->source_location) }}">
                <p class="mt-1 text-sm text-gray-500">Paste the full Google Maps URL for this location</p>
                @error('source_location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Images -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                @if($foodPlace->images->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($foodPlace->images as $image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     class="w-full h-40 object-cover rounded-lg shadow-sm border border-gray-200">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-200 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <label class="inline-flex items-center px-3 py-1 bg-white rounded-full shadow cursor-pointer">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                                               class="form-checkbox h-4 w-4 text-yellow-600 transition duration-150">
                                        <span class="ml-2 text-sm font-medium text-gray-700">Delete</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No images uploaded yet</p>
                @endif
            </div>

            <!-- New Images -->
            <div class="mb-6">
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
                                <span>Upload files</span>
                                <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*" onchange="previewImages(this)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB (max 5 images)</p>
                    </div>
                </div>

                <!-- Image Preview Container -->
                <div id="imagePreviewContainer" class="mt-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 hidden"></div>

                @error('images')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.food-places.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <a href="{{ route('admin.food-places.index', $foodPlace->id) }}" class="text-white">
                    Update Food Place
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const imageFiles = [];

    function previewImages(input) {
        const previewContainer = document.getElementById('imagePreviewContainer');
        previewContainer.innerHTML = '';
        imageFiles.length = 0; // Clear array

        if (input.files && input.files.length > 0) {
            previewContainer.classList.remove('hidden');

            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const reader = new FileReader();

                imageFiles.push(file); // store file

                reader.onload = function(e) {
                    const index = imageFiles.length - 1;
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-40 object-cover rounded-lg border border-gray-200">
                        <button type="button" onclick="removeImagePreview(${index})" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    `;
                    previewContainer.appendChild(div);
                }

                reader.readAsDataURL(file);
            }

            updateFileList();
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    function removeImagePreview(index) {
        imageFiles.splice(index, 1);

        const dataTransfer = new DataTransfer();
        imageFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('images').files = dataTransfer.files;

        previewImages(document.getElementById('images'));
    }

    function updateFileList() {
        const dataTransfer = new DataTransfer();
        imageFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('images').files = dataTransfer.files;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('images');
        input.addEventListener('change', function () {
            previewImages(input);
        });
    });
</script>
@endpush
