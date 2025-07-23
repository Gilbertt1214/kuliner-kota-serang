@extends('layouts.app')

@section('title', 'Edit Profile - Kuliner Kota Serang')

@section('content')
    <!-- Profile Header with Hero Background -->
    <div class="bg-gradient-to-r from-orange-600 to-orange-400 text-white py-16 pt-24">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="w-24 h-24 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Pengaturan Profile</h1>
                <p class="text-orange-100">Kelola informasi akun dan preferensi Anda</p>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Profile Information Card -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-orange-400 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Profile
                    </h2>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Card -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-400 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Ubah Password
                    </h2>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border-l-4 border-red-500">
                <div class="bg-gradient-to-r from-red-500 to-red-400 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        Zona Berbahaya
                    </h2>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom form styling */
        .form-input {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300;
        }

        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
        }
    </style>
@endsection
