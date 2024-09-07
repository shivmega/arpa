<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Rincian Desa {{ $desa->nama_desa }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Don't use this in production: -->

</head>

<body class="dark:bg-gray-900 bg-gray-200">
    @include('sidebar')
    <main class="p-4 md:ml-64 h-auto pt-20 ">
        <div class=" rounded-lg dark:bg-gray-800 bg-white border-gray-300 dark:border-gray-600 h-auto mb-4 px-3 py-4">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Data Desa</h2>

            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="nama_desa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Desa</label>
                    <input type="text" name="nama_desa" id="nama_desa"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->nama_desa }}" placeholder="contoh: Rejasa" disabled>
                </div>
                <div class="w-full">
                    <label for="nama_kades" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Kepala
                        Desa</label>
                    <input type="text" name="nama_kades" id="nama_kades"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->nama_kades }}" placeholder="contoh: Lukman Indrajaya"  disabled>
                </div>
                <div class="w-full">
                    <label for="nama_sekdes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Sekretaris
                        Desa</label>
                    <input type="text" name="nama_sekdes" id="nama_sekdes"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->nama_sekdes }}" placeholder="" disabled>
                </div>
                <div class="w-full">
                    <label for="nama_perangkat_desa"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Perangkat Desa</label>
                    <input type="text" name="nama_perangkat_desa" id="nama_perangkat_desa"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->nama_perangkat_desa }}" disabled>
                </div>
                <div class="w-full">
                    <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->kecamatan }}" placeholder="" disabled>
                </div>
                <div class="w-full">
                    <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kabupaten</label>
                    <input type="text" name="kabupaten" id="kabupaten"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->kabupaten }}" placeholder="" disabled>
                </div>
                <div class="w-full">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat</label>
                    <input type="text" name="alamat" id="alamat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->alamat }}" disabled>
                </div>
                <div class="w-full">
                    <label for="jumlah_penduduk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jumlah Penduduk</label>
                    <input type="number" name="jumlah_penduduk" id="jumlah_penduduk"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->jumlah_penduduk }}" disabled>
                </div>
                <div class="w-full">
                    <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="{{ $desa->keterangan }}" disabled>
                </div>

    </main>
</body>

</html>
