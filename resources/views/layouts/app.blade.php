<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Sistem Pembiayaan' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white min-h-screen">

            <div class="px-6 py-5 border-b border-slate-700">
                <h1 class="text-xl font-bold">
                    Sistem Pembiayaan
                </h1>

                <p class="text-sm text-slate-400 mt-1">
                    Internal Tool
                </p>
            </div>

            <nav class="p-4 space-y-2">

                <a href="/"
                   class="flex items-center px-4 py-3 rounded-lg bg-slate-800 hover:bg-slate-700 transition">
                    Dashboard
                </a>

                <a href="{{ route('applications.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    Pengajuan
                </a>

            </nav>

        </aside>

        {{-- Main Content --}}
        <main class="flex-1">

            {{-- Header --}}
            <header class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-lg font-semibold">
                            {{ $title ?? 'Dashboard' }}
                        </h2>
                    </div>

                    <div class="flex items-center gap-4">
    <span class="text-sm font-medium text-gray-700">
        Admin Internal
    </span>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button
            type="submit"
            class="px-3 py-2 text-sm text-red-600 border border-red-100 rounded-lg hover:bg-red-50 transition">
            Logout
        </button>
    </form>
</div>

                </div>
            </header>

            {{-- Content --}}
            <div class="p-8">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>