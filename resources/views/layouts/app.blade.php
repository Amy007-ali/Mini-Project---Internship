<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Lebanon Explorer')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-gray-100 text-gray-900 min-h-screen">


    {{-- =========================================================
         NAVBAR
    ========================================================== --}}
    <nav class="bg-white border-b border-gray-200">

        <div
            class="max-w-7xl mx-auto px-6 py-4
                   flex items-center justify-between"
        >


            {{-- LOGO --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3"
            >

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Lebanon Explorer Logo"
                    class="w-10 h-10 object-contain"
                >

                <span class="text-xl font-bold text-gray-900">
                    Lebanon Explorer
                </span>

            </a>



            {{-- NAVIGATION LINKS --}}
            <div class="flex items-center gap-7">


                {{-- DASHBOARD --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="
                        font-medium transition
                        {{ request()->routeIs('dashboard')
                            ? 'text-green-700'
                            : 'text-gray-700 hover:text-green-700'
                        }}
                    "
                >
                    Dashboard
                </a>


                {{-- PLACES --}}
                <a
                    href="{{ route('places.index') }}"
                    class="
                        font-medium transition
                        {{ request()->routeIs('places.*')
                            ? 'text-green-700'
                            : 'text-gray-700 hover:text-green-700'
                        }}
                    "
                >
                    Places
                </a>


                {{-- CATEGORIES --}}
                <a
                    href="{{ route('categories.index') }}"
                    class="
                        font-medium transition
                        {{ request()->routeIs('categories.*')
                            ? 'text-green-700'
                            : 'text-gray-700 hover:text-green-700'
                        }}
                    "
                >
                    Categories
                </a>


            </div>

        </div>

    </nav>



    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}
    <main class="max-w-7xl mx-auto px-6 py-10">


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div
                class="mb-8
                       rounded-xl
                       bg-green-100
                       border border-green-200
                       px-5 py-4
                       text-green-800"
            >
                {{ session('success') }}
            </div>

        @endif



        {{-- ERROR MESSAGE --}}
        @if (session('error'))

            <div
                class="mb-8
                       rounded-xl
                       bg-red-100
                       border border-red-200
                       px-5 py-4
                       text-red-800"
            >
                {{ session('error') }}
            </div>

        @endif



        {{-- PAGE CONTENT --}}
        @yield('content')


    </main>


</body>

</html>