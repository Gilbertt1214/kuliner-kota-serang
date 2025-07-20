<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #1e293b;
        }

        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }

        .content-area {
            min-height: calc(100vh - 80px);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #6366f1;
            border-radius: 9999px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #4f46e5;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased" x-data="{ sidebarOpen: window.innerWidth >= 1280 }">
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <!-- Sidebar -->
    @include('admin.components.sidebar')

    <!-- Main Content Wrapper -->
    <div class="flex flex-col min-h-screen lg:ml-64 transition-all duration-300 ease-in-out">
        <!-- Navbar -->
        @include('admin.components.navbar')

        <!-- Main Content Area -->
        <main class="flex-grow px-4 py-6 sm:px-6 lg:px-8 content-area">
            <!-- Page Header -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-2xl font-bold text-gray-800">
                    @yield('page-title', 'Dashboard')
                </h2>
                <div class="mt-2 sm:mt-0">
                    @yield('breadcrumbs')
                </div>
            </div>

            <!-- Page Content -->
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 px-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <p class="text-sm text-gray-600">
                    &copy; <span id="current-year"></span> Your Company. All rights reserved.
                </p>
                <p class="text-sm text-gray-600 mt-2 md:mt-0">
                    v1.0.0
                </p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set current year
            document.getElementById('current-year').textContent = new Date().getFullYear();

            // Initialize Perfect Scrollbar
            if (typeof PerfectScrollbar !== 'undefined') {
                new PerfectScrollbar('.content-area', { suppressScrollX: true });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
