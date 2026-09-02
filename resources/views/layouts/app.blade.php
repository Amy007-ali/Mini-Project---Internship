<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Lebanon Explorer')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <a href="{{ route('places.index') }}"
               class="text-xl font-bold">
                Lebanon Explorer
            </a>

            <div class="flex gap-6">

                <a href="{{ route('places.index') }}"
                   class="hover:text-green-700">
                    Places
                </a>

                <a href="{{ route('categories.index') }}"
                   class="hover:text-green-700">
                    Categories
                </a>

            </div>

        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">

        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</body>

</html>