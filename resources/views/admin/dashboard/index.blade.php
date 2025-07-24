@extends('layouts.admin')

@section('content')
    <!-- Dashboard Header -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- Dashboard Stats -->
        <div class="flex flex-wrap -mx-3">
            <!-- Total Categories Card -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-400">Categories
                                    </p>
                                    <h5 class="mb-0 font-bold">{{ $categories->count() }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                    <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Restaurants Card -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-400">
                                        Restaurants</p>
                                    <h5 class="mb-0 font-bold">{{ $foodPlaces->count() ?? 0 }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-400">
                                    <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users Card -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-400">Users</p>
                                    <h5 class="mb-0 font-bold">{{ $users->count() ?? 0 }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-lime-400">
                                    <i class="ni leading-none ni-circle-08 text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Reviews Card -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal text-slate-400">Reviews
                                    </p>
                                    <h5 class="mb-0 font-bold">{{ $reviews->count() ?? 0 }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-red-500 to-yellow-400">
                                    <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Categories Table -->
        <div class="flex flex-wrap -mx-3 mt-6">
            <div class="w-full max-w-full px-3 lg:w-7/12 lg:flex-none">
                @component('admin.components.table', [
                    'title' => 'Recent Categories',
                    'headers' => ['ID', 'Name', 'Created At', 'Actions'],
                ])
                    @foreach ($categories->take(5) as $category)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">{{ $category->id }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal">{{ $category->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight text-slate-400">
                                    {{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}
                                </span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-xs font-semibold leading-tight text-blue-500 hover:text-blue-700 mr-2">
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $category->id }})"
                                    class="text-xs font-semibold leading-tight text-red-500 hover:text-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endcomponent

                <div class="mt-4">
                    <a href="{{ route('admin.categories.index') }}"
                        class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg shadow-soft-md bg-x-25 bg-150 leading-pro tracking-tight-soft hover:shadow-soft-xs active:opacity-85">
                        View All Categories
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <div class="space-y-3">
                            <a href="{{ route('admin.categories.create') }}"
                                class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-plus text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm font-semibold">Add New Category</h6>
                                    <p class="mb-0 text-xs text-slate-400">Create a new restaurant category</p>
                                </div>
                            </a>


                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm font-semibold">Manage Users</h6>
                                    <p class="mb-0 text-xs text-slate-400">View and manage user accounts</p>
                                </div>
                            </a>

                            {{-- <a href="{{ route('admin.reviews.index') }}"
                                class="flex items-center p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                                <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm font-semibold">Review Management</h6>
                                    <p class="mb-0 text-xs text-slate-400">Moderate restaurant reviews</p>
                                </div>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Script -->
    <script>
        function confirmDelete(categoryId) {
            if (confirm('Are you sure you want to delete this category?')) {
                // Create form for DELETE request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/categories/${categoryId}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
