<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 "
        style="background-image: url('{{ asset('images/candi_arjuna.jpg') }}')">
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 backdrop-blur-xl bg-white/50 rounded-lg shadow ">
            <a href="" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-5 ">
                <img src=""
                    class="mr-4 h-16 flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 ">ARPA
            </a>
            <h2 class="text-2xl font-bold text-gray-900 ">
                Masuk Ke Akun Desa Anda
            </h2>
            <form class="mt-8 space-y-6" action="login" method="POST" role="form">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="name@company.com" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required="">
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Login</button>
                <div class="flex items-end">
                    <a href="{{ route('registrasi') }}"class="text-blue-700 hover:underline"> Buat Akun Baru</a>
                    <a href="{{ route('lupa_password') }}" class="ml-auto  text-blue-700 hover:underline ">Lupa
                        Password?</a>
                </div>
            </form>

        </div>

    </div>

</body>

</html>
