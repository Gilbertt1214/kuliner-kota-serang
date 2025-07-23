@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Edit Kategori</h2>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.categories.index') }}"
                    class="text-gray-600 hover:text-blue-600 text-sm font-medium transition duration-150">
                    ← Kembali
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition duration-150">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
