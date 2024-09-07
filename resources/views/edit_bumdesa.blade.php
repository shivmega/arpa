<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Tambah BUMDesa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Don't use this in production: -->

</head>

<body class="dark:bg-gray-900 bg-gray-200">
    @include('sidebar')
    <main class="p-4 md:ml-64 h-auto pt-20 ">
        <div class=" rounded-lg dark:bg-gray-800 bg-white border-gray-300 dark:border-gray-600 h-auto mb-4 px-3 py-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data BUMDesa</h2>
            <form action="{{ route('edit.bumdesa', ['bumdesa' => $bumdesa]) }}" method="POST" role="form">

                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="nama_bumdesa"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            BUMDesa</label>
                        <input type="text" name="nama_bumdesa" id="nama_bumdesa"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $bumdesa->nama_bumdesa }}" placeholder="" required>
                    </div>
                    <div class="w-full">
                        <label for="nama_direktur"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Direktur
                            BUMDesa</label>
                        <input type="text" name="nama_direktur" id="nama_direktur"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $bumdesa->nama_direktur }}" placeholder="contoh: Lukman Indrajaya" required>
                    </div>
                    <div class="w-full">
                        <label for="aktifitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Aktifitas</label>
                        <select type="text" name="aktifitas" id="aktifitas"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($aktifitas as $item)
                                <option value="{{ $item }}"{{ $bumdesa->aktifitas == $item ? 'selected' : '' }}>
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
                                    <option value="{{ $item }}"{{ $bumdesa->kategori == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 inline ml-5">
                            <label for="jumlah_pekerja"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jumlah Pekerja</label>
                            <input type="number" name="jumlah_pekerja" id="jumlah_pekerja"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="{{ $bumdesa->jumlah_pekerja }}">
                        </div>
                    </div>
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <label for="desa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Desa</label>

                            @if (Auth::user()->role == 'desa')
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
                                        <option value="{{ $desa->id }}"{{ $bumdesa->desa == $desa->id ? 'selected' : '' }}>
                                            {{ $desa->nama_desa }}, Kecamatan {{ $desa->kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                            {{-- <select id="desa" name="desa"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($desas as $desa)
                                    <option
                                        value="{{ $desa->id }} "{{ $bumdesa->desa == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama_desa }}
                                    </option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div class="w-1/2 inline ml-5">
                            <label for="tahun_berdiri"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Tahun Berdiri</label>
                            <select id="tahun_berdiri" name="tahun_berdiri"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @for ($tahun = 2023; $tahun >= 1980; $tahun--)
                                    <option
                                        value="{{ $tahun }}"{{ $bumdesa->tahun_berdiri == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="status_hukum" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status Hukum</label>
                        <input type="text" name="status_hukum" id="status_hukum"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $bumdesa->status_hukum }}">
                    </div>
                    <div class="w-full">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Alamat</label>
                        <input type="text" name="alamat" id="alamat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $bumdesa->alamat }}">
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Edit Data BUMDesa
                        </button>
                    </div>
    </main>
</body>

</html>
