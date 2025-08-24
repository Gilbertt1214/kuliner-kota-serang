<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SANTARA')</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    @vite('resources/js/app.js')
</body>

</html>
