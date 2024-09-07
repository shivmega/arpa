<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Tambah UMKM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Don't use this in production: -->

</head>

<body class="dark:bg-gray-900 bg-gray-200">
    @include('sidebar')
    <main class="p-4 md:ml-64 h-auto pt-20 ">
        <div class=" rounded-lg dark:bg-gray-800 bg-white border-gray-300 dark:border-gray-600 h-auto mb-4 px-3 py-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data UMKM</h2>
            <form action="{{ route('tambah.umkm') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="w-full">
                        <label for="nama_umkm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            UMKM</label>
                        <input type="text" name="nama_umkm" id="nama_umkm"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="" required>
                    </div>
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <label for="produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Produk</label>
                            <input type="text" name="produk" id="produk"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="" placeholder="contoh: Keripik Pisang" required>
                        </div>
                        <div class="w-1/2 ml-5">
                            <label for="pemilik_umkm"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pemilik UMKM</label>
                            <input type="text" name="pemilik_umkm" id="pemilik_umkm"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="" placeholder="Ibu Marsinah">
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="foto_produk">Foto Produk</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="foto_produk" type="file" name="foto_produk"
                            value="">
                        <p class="mt-1 ml-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG
                            or
                            JPEG (MAX. 2MB).</p>
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
                                        <option value="{{ $desa->id }} ">
                                            {{ $desa->nama_desa }}, Kecamatan {{ $desa->kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="w-1/2 inline ml-5">
                            <label for="tahun_berdiri"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Tahun Berdiri</label>
                            <select id="tahun_berdiri" name="tahun_berdiri"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">-</option>
                                @for ($tahun = 2024; $tahun >= 1980; $tahun--)
                                    <option value="{{ $tahun }}">
                                        {{ $tahun }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <label for="jangkauan_pasar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jangkauan Pasar</label>
                            <input type="text" name="jangkauan_pasar" id="jangkauan_pasar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="">
                        </div>
                        <div class="w-1/2 inline ml-5">
                            <label for="omset" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Omset</label>
                            <input type="number" name="omset" id="omset"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="">
                        </div>
                    </div>
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <label for="jumlah_pekerja"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jumlah Pekerja</label>
                            <input type="number" name="jumlah_pekerja" id="jumlah_pekerja"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="">
                        </div>
                        <div class="w-1/2 inline ml-5">
                            <label for="kontak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kontak</label>
                            <input type="text" name="kontak" id="kontak"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="">
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="w-full">
                            <label for="alamat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="">
                        </div>
                        <div class="w-full mt-5">
                            <label for="keterangan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="">
                        </div>
                    </div>
                    <div class="w-full text-sm font-medium text-gray-900 dark:text-gray-300 ">
                        Pasar Online
                        <div class="flex">
                            <div class="w-1/3">
                                <div class="w-full items-center mt-2">
                                    <input id="online1" type="checkbox" value="Whatsapp" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online1"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Whatsapp
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online2" type="checkbox" value="Shopee" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online2"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Shopee
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online3" type="checkbox" value="TikTok" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online3"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">TikTok
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online4" type="checkbox" value="Tokopedia" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online4"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tokopedia
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online5" type="checkbox" value="Amazon" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online5"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Amazon
                                    </label>
                                </div>

                            </div>
                            <div class="w-1/3 inline">
                                <div class="w-full items-center mt-2">
                                    <input id="online6" type="checkbox" value="Whatsapp_business"
                                        name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online6"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Whatsapp
                                        Business
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online7" type="checkbox" value="Website" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online7"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Website
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online8" type="checkbox" value="Youtube" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online8"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Youtube
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online9" type="checkbox" value="E-Katalog" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online9"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">E-Katalog
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online10" type="checkbox" value="Google Ads" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online10"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Google Ads
                                    </label>
                                </div>

                            </div>
                            <div class="w-1/3 inline">
                                <div class="w-full items-center mt-2">
                                    <input id="online11" type="checkbox" value="Instagram" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online11"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Instagram
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online12" type="checkbox" value="Facebook" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online12"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Facebook
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online13" type="checkbox" value="SMS_Telepon" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online13"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SMS dan
                                        Telepon
                                    </label>
                                </div>
                                <div class="w-full items-center mt-2">
                                    <input id="online14" type="checkbox" value="Marketplace" name="pasar_online[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="online14"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Marketplace
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Tambah Data UMKM
                        </button>
                    </div>
                </div>

        </div>
    </main>
</body>

</html>
