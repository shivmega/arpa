<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Rincian Laporan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Don't use this in production: -->

</head>

<body class="dark:bg-gray-900 bg-gray-200">
    @include('sidebar')
    <main class="p-4 md:ml-64 h-auto pt-20 ">
        <div class=" rounded-lg dark:bg-gray-800 bg-white border-gray-300 dark:border-gray-600 h-auto mb-4 px-3 py-4">
            {{-- @if (session('error'))
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Error:</span>
                        
                    </div>
                </div>
            @endif --}}

            
            
        </div>
    </main>
</body>

</html>
