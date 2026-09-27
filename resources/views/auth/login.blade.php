<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Pembiayaan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">
                    Aplikasi Pembiayaan
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Login untuk mengakses sistem internal
                </p>
            </div>

            @if($errors->any())
                <div class="mb-5 p-3 bg-red-50 border border-red-100 text-red-600 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" class="space-y-5">

                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@gmail.com"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900/10"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-900/10"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full py-3 bg-gray-900 text-white rounded-xl font-medium hover:bg-gray-800 transition">
                    Login
                </button>

            </form>

        </div>

    </div>

</body>
</html>