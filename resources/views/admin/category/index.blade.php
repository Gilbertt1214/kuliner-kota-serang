@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-4">
    <!-- Add Category Button -->
    <div class="flex justify-end">
        <a href="{{ route('admin.categories.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Category
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Categories Table -->
    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-center">Created At</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($categories as $category)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        {{ $category->id }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $category->name }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        {{ $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : '-' }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 ml-2"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="p-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
