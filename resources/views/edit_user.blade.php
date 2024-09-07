<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Profil Pengguna</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Don't use this in production: -->

</head>

<body class="dark:bg-gray-900 bg-gray-200">
    @include('sidebar')
    <main class="p-4 md:ml-64 h-auto pt-20 ">
        <div class=" rounded-lg dark:bg-gray-800 bg-white border-gray-300 dark:border-gray-600 h-auto mb-4 px-3 py-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data Pengguna</h2>
            <form action="#">
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Pengguna</label>
                        <input type="text" name="name" id="name" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ Auth::user()->name }}" >
                    </div>
                    <div class="w-full">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ Auth::user()->email }}"  disabled>
                    </div>
                    @if (Auth::user()->role == 'desa')
                       <div class="w-full">
                        <label for="desa"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                        <input type="desa" name="desa" id="desa"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{$desas->find(Auth::user()->desa)->nama_desa}}" disabled>
                    </div>
                    <div class="w-full">
                        <label for="Kecamatan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                        <input type="text" name="Kecanatan" id="Kecamatan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{$desas->find(Auth::user()->desa)->kecamatan}}"  disabled>
                    </div> 
                    @endif
                    


                    {{-- <div class="w-full">

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="foto_profil">Upload foto</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="foto_profil" type="file" name="foto_profil" value="{{Auth::user()->foto_profil}}">
                        <p class="mt-1 ml-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or
                            JPEG (MAX. 2MB).</p>
                    </div>        --}}
                
    </main>
</body>

</html>
