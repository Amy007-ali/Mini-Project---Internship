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
    <nav
        class="bg-white
               border-b border-gray-200
               sticky top-0
               z-50"
    >

        <div class="max-w-7xl mx-auto px-5 md:px-6">

            <div
                class="h-20
                       flex items-center
                       justify-between"
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

                    <span
                        class="text-lg
                               sm:text-xl
                               font-bold
                               text-gray-900"
                    >
                        Lebanon Explorer
                    </span>

                </a>


                {{-- DESKTOP NAV --}}
                <div class="hidden md:flex items-center gap-8">

                    <a
                        href="{{ route('dashboard') }}"
                        class="font-medium transition
                               {{ request()->routeIs('dashboard')
                                    ? 'text-green-700'
                                    : 'text-gray-600 hover:text-green-700'
                               }}"
                    >
                        Dashboard
                    </a>


                    <a
                        href="{{ route('places.index') }}"
                        class="font-medium transition
                               {{ request()->routeIs('places.*')
                                    ? 'text-green-700'
                                    : 'text-gray-600 hover:text-green-700'
                               }}"
                    >
                        Places
                    </a>


                    <a
                        href="{{ route('categories.index') }}"
                        class="font-medium transition
                               {{ request()->routeIs('categories.*')
                                    ? 'text-green-700'
                                    : 'text-gray-600 hover:text-green-700'
                               }}"
                    >
                        Categories
                    </a>

                </div>


                {{-- MOBILE BUTTON --}}
                <button
                    type="button"
                    onclick="toggleMobileMenu()"
                    class="md:hidden
                           w-10 h-10
                           border border-gray-200
                           rounded-lg
                           flex items-center
                           justify-center
                           text-gray-700
                           hover:bg-gray-100
                           transition"
                    aria-label="Open navigation menu"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                        />
                    </svg>
                </button>

            </div>


            {{-- MOBILE MENU --}}
            <div
                id="mobileMenu"
                class="hidden md:hidden pb-5"
            >

                <div
                    class="border-t
                           border-gray-100
                           pt-4
                           flex flex-col
                           gap-2"
                >

                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-3
                               rounded-lg
                               font-medium"
                               {{ request()->routeIs('dashboard')
                                    ? 'bg-green-50 text-green-700'
                                    : 'text-gray-700 hover:bg-gray-100'
                               }}"
                    >
                        Dashboard
                    </a>


                    <a
                        href="{{ route('places.index') }}"
                        class="px-4 py-3
                               rounded-lg
                               font-medium
                               {{ request()->routeIs('places.*')
                                    ? 'bg-green-50 text-green-700'
                                    : 'text-gray-700 hover:bg-gray-100'
                               }}"
                    >
                        Places
                    </a>


                    <a
                        href="{{ route('categories.index') }}"
                        class="px-4 py-3
                               rounded-lg
                               font-medium
                               {{ request()->routeIs('categories.*')
                                    ? 'bg-green-50 text-green-700'
                                    : 'text-gray-700 hover:bg-gray-100'
                               }}"
                    >
                        Categories
                    </a>

                </div>

            </div>

        </div>

    </nav>


    {{-- =========================================================
         MAIN
    ========================================================== --}}
    <main
        class="max-w-7xl
               mx-auto
               px-5 md:px-6
               py-8 md:py-10"
    >

        {{-- SUCCESS --}}
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


        {{-- ERROR --}}
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


        @yield('content')

    </main>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}
    <script>

        function toggleMobileMenu() {

            const menu =
                document.getElementById('mobileMenu');

            menu.classList.toggle('hidden');

        }

    </script>


</body>

</html>