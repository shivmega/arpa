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
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data Laporan</h2>
            <form action="{{ route('edit.laporan', ['laporan'=>$laporan]) }}" method="POST" role="form">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Institusi</label>
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $laporan->nama }}" disabled>
                    </div>
                    <div class="w-full">
                        <label for="institusi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Institusi
                        </label>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 ml-3">
                                <div class="flex items-center ps-3">
                                    <input id="horizontal-list-radio-license" type="radio" value="umkm" disabled
                                        name="institusi" id="institusi" @checked($laporan->institusi == 'umkm')
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-license"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">UMKM
                                    </label>
                                </div>
                            </li>
                            <li class="w-full dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="horizontal-list-radio-passport" type="radio" value="bumdesa" disabled
                                        name="institusi" id="institusi" @checked($laporan->institusi == 'bumdes')
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-passport"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">BUMDESA</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <label for="desa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Desa</label>
                            {{-- @if (Auth::user()->role == 'desa')
                                <div
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    Desa {{ $desa_pengguna->nama_desa }}, Kecamatan {{ $desa_pengguna->kecamatan }}
                                </div>
                                <input type="hidden" name="desa" id="desa" hidden
                                    value="{{ $desa_pengguna->id }}">
                            @else
                                <select id="desa" name="desa"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($desas as $desa)
                                        <option value="{{ $desa->id }} ">
                                            Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif --}}
                            <input type="text" name="desa" id="desa" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="Desa {{ $desa->nama_desa }}, Kecamatan {{ $desa->kecamatan }}" placeholder="">
                        </div>
                        <div class="w-1/2 inline ml-5">
                            <label for="periode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Periode</label>
                            <select id="periode" name="periode" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @for ($tahun = 2024; $tahun >= 1980; $tahun--)
                                    <option @selected($tahun == $laporan->periode) value="{{ $tahun }}">
                                        {{ $tahun }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="penyertaan_modal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penyertaan Modal
                        </label>
                        <input type="number" name="penyertaan_modal" id="penyertaan_modal" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $laporan->penyertaan_modal }}">
                    </div>
                    <div class="w-full">
                        <label for="omzet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Omzet</label>
                        <input type="text" name="omzet" id="omzet" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $laporan->omzet }}" placeholder="">
                    </div>
                    <div class="w-full">
                        <label for="pendapatan_bersih"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Pendapatan Bersih</label>
                        <input type="number" name="pendapatan_bersih" id="pendapatan_bersih"disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $laporan->pendapatan_bersih }}" placeholder="">
                    </div>
                    <div class="w-full">
                        <label for="kontribusi_pades"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kontribusi Pades</label>
                        <input type="number" name="kontribusi_pades" id="kontribusi_pades" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $laporan->kontribusi_pades }}">
                    </div>

    </main>
</body>

</html>
