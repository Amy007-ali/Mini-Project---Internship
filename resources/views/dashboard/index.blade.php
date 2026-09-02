@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- =========================================================
         HERO
    ========================================================== --}}
    <section class="mb-14">

        <div
            class="relative overflow-hidden
                   bg-gradient-to-br
                   from-green-900
                   via-green-800
                   to-green-700
                   rounded-3xl
                   px-7 py-10
                   md:px-12 md:py-14
                   shadow-lg"
        >

            {{-- DECORATIVE CIRCLES --}}
            <div
                class="absolute
                       -right-20 -top-20
                       w-72 h-72
                       rounded-full
                       bg-white/5"
            ></div>

            <div
                class="absolute
                       right-32 -bottom-24
                       w-56 h-56
                       rounded-full
                       bg-white/5"
            ></div>


            <div class="relative max-w-3xl">

                <h1
                    class="text-3xl
                           md:text-5xl
                           font-bold
                           text-white
                           leading-tight"
                >
                    Discover the beauty of Lebanon.
                </h1>


                <p
                    class="text-green-100
                           text-lg
                           mt-5
                           max-w-2xl
                           leading-relaxed"
                >
                    Explore remarkable natural, historical, and cultural
                    destinations from across the country.
                </p>


                <div class="mt-8">

                    <a
                        href="{{ route('places.index') }}#explore-places"
                        class="inline-flex
                               bg-white
                               text-green-800
                               px-6 py-3
                               rounded-xl
                               font-bold
                               hover:bg-green-50
                               transition"
                    >
                        Explore Destinations
                    </a>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         OVERVIEW
    ========================================================== --}}
    <section class="mb-14">

        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-900">
                Overview
            </h2>

            <p class="text-gray-500 mt-1">
                A quick look at your Lebanon Explorer collection.
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- TOTAL PLACES --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       p-6
                       shadow-sm
                       hover:shadow-md
                       transition"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-gray-500">
                            TOTAL PLACES
                        </p>

                        <p class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $totalPlaces }}
                        </p>

                    </div>


                    <div
                        class="w-14 h-14
                               rounded-2xl
                               bg-green-100
                               flex items-center
                               justify-center
                               text-2xl"
                    >
                        📍
                    </div>

                </div>

            </div>


            {{-- CATEGORIES --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       p-6
                       shadow-sm
                       hover:shadow-md
                       transition"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-gray-500">
                            CATEGORIES
                        </p>

                        <p class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $totalCategories }}
                        </p>

                    </div>


                    <div
                        class="w-14 h-14
                               rounded-2xl
                               bg-blue-100
                               flex items-center
                               justify-center
                               text-2xl"
                    >
                        🗂️
                    </div>

                </div>

            </div>


            {{-- FEATURED --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       p-6
                       shadow-sm
                       hover:shadow-md
                       transition"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold text-gray-500">
                            FEATURED
                        </p>

                        <p class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $featuredCount }}
                        </p>

                    </div>


                    <div
                        class="w-14 h-14
                               rounded-2xl
                               bg-yellow-100
                               flex items-center
                               justify-center
                               text-2xl"
                    >
                        ⭐
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         FEATURED DESTINATIONS
    ========================================================== --}}
    <section class="mb-14">

        <div
            class="flex flex-col
                   sm:flex-row
                   sm:items-end
                   sm:justify-between
                   gap-4
                   mb-6"
        >

            <div>

                <h2 class="text-2xl font-bold text-gray-900">
                    Featured Destinations
                </h2>

                <p class="text-gray-500 mt-1">
                    A selection of highlighted places to discover.
                </p>

            </div>


            <a
                href="{{ route('places.index') }}#explore-places"
                class="text-green-700
                       font-bold
                       hover:text-green-800"
            >
                View all places →
            </a>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse ($featuredPlaces as $place)

                <article
                    class="group
                           bg-white
                           rounded-2xl
                           overflow-hidden
                           border border-gray-200
                           shadow-sm
                           hover:shadow-lg
                           transition
                           duration-300"
                >

                    <div class="relative overflow-hidden">

                        @if ($place->image)

                            <img
                                src="{{ asset('storage/' . $place->image) }}"
                                alt="{{ $place->name }}"
                                class="w-full h-60
                                       object-cover
                                       group-hover:scale-105
                                       transition-transform
                                       duration-500"
                            >

                        @else

                            <img
                                src="{{ asset('images/place-placeholder.jpg') }}"
                                alt="Place placeholder"
                                class="w-full h-60 object-cover"
                            >

                        @endif


                        <span
                            class="absolute
                                   top-4 right-4
                                   bg-white/95
                                   text-yellow-700
                                   text-xs
                                   font-bold
                                   px-3 py-1.5
                                   rounded-full
                                   shadow"
                        >
                            ★ Featured
                        </span>

                    </div>


                    <div class="p-6">

                        <span
                            class="inline-block
                                   bg-green-100
                                   text-green-800
                                   text-sm
                                   font-semibold
                                   px-3 py-1
                                   rounded-full"
                        >
                            {{ $place->category->name }}
                        </span>


                        <h3 class="text-xl font-bold text-gray-900 mt-4">
                            {{ $place->name }}
                        </h3>


                        <p class="text-gray-500 mt-1">
                            {{ $place->region }}
                        </p>


                        <p class="text-gray-600 mt-4 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($place->description, 105) }}
                        </p>


                        <div class="mt-5 pt-4 border-t border-gray-100">

                            <span class="text-sm text-gray-500">
                                Entry Fee
                            </span>


                            <p class="font-bold text-gray-900 mt-1">

                                @if ($place->entry_fee !== null)

                                    ${{ number_format($place->entry_fee, 2) }}

                                @else

                                    Free / Not specified

                                @endif

                            </p>

                        </div>

                    </div>

                </article>

            @empty

                <div
                    class="md:col-span-2
                           lg:col-span-3
                           bg-white
                           border border-gray-200
                           rounded-2xl
                           p-12
                           text-center"
                >

                    <div class="text-4xl">
                        ⭐
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mt-4">
                        No featured destinations yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Mark a place as featured to display it here.
                    </p>

                </div>

            @endforelse

        </div>

    </section>


    {{-- =========================================================
         RECENTLY ADDED
    ========================================================== --}}
    <section>

        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-900">
                Recently Added
            </h2>

            <p class="text-gray-500 mt-1">
                The latest destinations added to Lebanon Explorer.
            </p>

        </div>


        <div
            class="bg-white
                   border border-gray-200
                   rounded-2xl
                   overflow-hidden
                   shadow-sm"
        >

            @forelse ($recentPlaces as $place)

                <div
                    class="flex flex-col
                           sm:flex-row
                           sm:items-center
                           gap-5
                           p-5
                           border-b
                           border-gray-100
                           last:border-b-0
                           hover:bg-gray-50
                           transition"
                >

                    @if ($place->image)

                        <img
                            src="{{ asset('storage/' . $place->image) }}"
                            alt="{{ $place->name }}"
                            class="w-full
                                   sm:w-24
                                   h-28
                                   sm:h-24
                                   object-cover
                                   rounded-xl"
                        >

                    @else

                        <img
                            src="{{ asset('images/place-placeholder.jpg') }}"
                            alt="Place placeholder"
                            class="w-full
                                   sm:w-24
                                   h-28
                                   sm:h-24
                                   object-cover
                                   rounded-xl"
                        >

                    @endif


                    <div class="flex-1">

                        <h3 class="text-lg font-bold text-gray-900">
                            {{ $place->name }}
                        </h3>

                        <p class="text-gray-500 text-sm mt-1">
                            {{ $place->region }}
                        </p>

                        <p class="text-gray-600 text-sm mt-2">
                            {{ \Illuminate\Support\Str::limit($place->description, 100) }}
                        </p>

                    </div>


                    <div class="flex sm:flex-col sm:items-end gap-2">

                        <span
                            class="inline-block
                                   bg-green-100
                                   text-green-800
                                   text-sm
                                   font-medium
                                   px-3 py-1
                                   rounded-full"
                        >
                            {{ $place->category->name }}
                        </span>

                    </div>

                </div>

            @empty

                <div class="p-12 text-center">

                    <div class="text-4xl">
                        📍
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mt-4">
                        No destinations yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Add your first place from the Places page.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

@endsection