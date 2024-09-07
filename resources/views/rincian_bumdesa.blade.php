<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Rincian BUMDesa {{ $bumdesa->nama_bumdesa }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Don't use this in production: -->

</head>

<body class="dark:bg-gray-900 bg-gray-200">
    @include('sidebar')
    <main class="p-4 md:ml-64 h-auto pt-20 ">
        <div class=" rounded-lg dark:bg-gray-800 bg-white border-gray-300 dark:border-gray-600 h-auto mb-4 px-3 py-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data BUMDesa</h2>
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="nama_bumdesa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        BUMDesa</label>
                    <input type="text" name="nama_bumdesa" id="nama_bumdesa"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $bumdesa->nama_bumdesa }}" placeholder="" disabled>
                </div>
                <div class="w-full">
                    <label for="nama_direktur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Direktur
                        BUMDesa</label>
                    <input type="text" name="nama_direktur" id="nama_direktur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $bumdesa->nama_direktur }}" placeholder="contoh: Lukman Indrajaya" disabled>
                </div>
                <div class="w-full">
                    <label for="aktifitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Aktifitas</label>
                    <select type="text" name="aktifitas" id="aktifitas" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @foreach ($aktifitas as $item)
                            <option disabled value="{{ $item }}"{{ $bumdesa->aktifitas == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="w-full flex">
                    <div class="w-1/2">
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kategori</label>
                        <select type="text" name="kategori" id="kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($kategori as $item)
                                <option disabled value="{{ $item }}"{{ $bumdesa->kategori == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/2 inline ml-5">
                        <label for="jumlah_pekerja"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Jumlah Pekerja</label>
                        <input type="number" name="jumlah_pekerja" id="jumlah_pekerja" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $bumdesa->jumlah_pekerja }}">
                    </div>
                </div>
                <div class="w-full flex">
                    <div class="w-1/2">
                        <label for="desa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Desa</label>
                        {{-- <select id="desa" name="desa" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($desas as $desa)
                                    <option value="{{ $desa->id }} "{{ $bumdesa->desa == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama_desa }}
                                    </option>
                                @endforeach
                            </select> --}}
                        <input type="text" name="desa" id="desa" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $desa->nama_desa }}">

                    </div>
                    <div class="w-1/2 inline ml-5">
                        <label for="tahun_berdiri"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Tahun Berdiri</label>
                        {{-- <select id="tahun_berdiri" name="tahun_berdiri" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @for ($tahun = 2023; $tahun >= 1980; $tahun--)
                                    <option value="{{ $tahun }}"{{ $bumdesa->tahun_berdiri == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endfor
                            </select> --}}
                        <input type="text" name="tahun_berdiri" id="tahun_berdiri" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $bumdesa->tahun_berdiri }}">
                    </div>
                </div>
                <div class="w-full">
                    <label for="status_hukum" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status Hukum</label>
                    <input type="text" name="status_hukum" id="status_hukum" disabled
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $bumdesa->status_hukum }}">
                </div>
                <div class="w-full">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat</label>
                    <input type="text" name="alamat" id="alamat" disabled
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $bumdesa->alamat }}">
                </div>
    </main>
</body>

</html>
