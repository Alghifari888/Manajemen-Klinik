<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Klinik Sehat') }} - Solusi Kesehatan Anda</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <svg class="h-20 w-auto bg-gray-100 dark:bg-gray-900" viewBox="0 0 1024 1024" fill="#10B981" xmlns="http://www.w3.org/2000/svg"><path d="M833.4 464.2c-15-64-53.5-120.3-107.2-161.6-59-46.3-131.2-71.1-209.1-71.1-66.2 0-128.8 19.3-181.7 54.3-54.7 36.1-94.8 87.3-116.1 148.8-4.5 13.2-12.2 40.4 1.7 52.8 13.1 11.6 38.3 4.2 51-2.9 2.5-1.4 5.3-3.2 8.1-5.3 18.2-13.6 38.3-24.8 59.9-33.4 34-13.4 70.8-20.2 109.1-20.2 61.3 0 119 18.9 167.3 54.3 53.7 39.3 88.5 97.4 96.6 160.1 2.3 17.5 8.9 51.5 26.6 51.5 16.5 0 25.1-32.9 26.6-51.4z m-413.5 156.4c-30.8 0-55.8 25-55.8 55.8s25 55.8 55.8 55.8 55.8-25 55.8-55.8-25-55.8-55.8-55.8z m256.7 0c-30.8 0-55.8 25-55.8 55.8s25 55.8 55.8 55.8 55.8-25 55.8-55.8-25.1-55.8-55.8-55.8z"/><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64z m255.4 624c-20.3 79.4-78.6 146.4-150.8 180.3-4.3 2-8.6 3.8-13 5.4-88.3 32-184.8 20.9-266.6-29-84-51.4-137.1-136.1-147.3-228-1.2-10.9-1.8-21.9-1.8-33 0-141.5 92.5-263.8 221.4-306.9 123-41.2 263.9-10.5 348.6 73.1 76.8 75.8 100.8 186.1 66.1 281.3-1.8 4.9-3.7 9.6-5.7 14.3z"/></svg>
                </div>

                <div class="mt-16 text-center">
                    <h1 class="text-4xl font-bold text-gray-800 dark:text-white">Selamat Datang di Klinik Sehat</h1>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Solusi kesehatan terpercaya untuk Anda dan keluarga. Buat janji temu dengan dokter kami secara mudah dan cepat.</p>
                </div>

                <div class="mt-12 flex justify-center gap-6">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-klinik-secondary hover:opacity-90">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-klinik-secondary bg-white hover:bg-gray-50 shadow-sm">
                        Masuk
                    </a>
                </div>

                <div class="mt-20">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-klinik-secondary text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="mt-5 text-lg font-medium text-gray-900 dark:text-white">Booking Online</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                Buat janji temu dengan dokter pilihan Anda kapan saja dan di mana saja tanpa antri.
                            </p>
                        </div>
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-klinik-secondary text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="mt-5 text-lg font-medium text-gray-900 dark:text-white">Antrian Digital</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                Dapatkan nomor antrian digital dan pantau status antrian Anda secara real-time dari dasbor.
                            </p>
                        </div>
                        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-klinik-secondary text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="mt-5 text-lg font-medium text-gray-900 dark:text-white">Riwayat Medis</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                Akses riwayat kunjungan dan hasil diagnosa dokter Anda dengan aman melalui akun pribadi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-start">
                        &copy; {{ date('Y') }} Klinik Sehat. All Rights Reserved.
                    </div>
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-4">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>