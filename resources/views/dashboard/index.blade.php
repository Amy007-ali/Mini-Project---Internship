@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


    {{-- =========================================================
         HERO / PAGE HEADER
    ========================================================== --}}
    <section class="mb-12">

        <div
            class="bg-white
                   border border-gray-200
                   rounded-2xl
                   p-8 md:p-10
                   shadow-sm"
        >

            <div
                class="flex flex-col
                       md:flex-row
                       md:items-center
                       md:justify-between
                       gap-6"
            >


                {{-- LEFT SIDE --}}
                <div>

                    <p
                        class="text-green-700
                               font-semibold
                               text-sm
                               uppercase
                               tracking-wide
                               mb-2"
                    >
                        Lebanon Explorer
                    </p>


                    <h1
                        class="text-3xl
                               md:text-4xl
                               font-bold
                               text-gray-900"
                    >
                        Discover Lebanon
                    </h1>


                    <p
                        class="text-gray-600
                               mt-3
                               max-w-2xl
                               leading-relaxed"
                    >
                        Explore and manage some of Lebanon's most beautiful
                        natural, historical, and cultural destinations.
                    </p>

                </div>



                {{-- BUTTON --}}
                <div>

                    <a
                        href="{{ route('places.index') }}"
                        class="inline-flex
                               bg-green-700
                               text-white
                               px-6 py-3
                               rounded-lg
                               font-medium
                               hover:bg-green-800
                               transition"
                    >
                        Explore Places
                    </a>

                </div>


            </div>

        </div>

    </section>



    {{-- =========================================================
         STATISTICS
    ========================================================== --}}
    <section class="mb-14">


        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-900">
                Overview
            </h2>

            <p class="text-gray-500 mt-1">
                A quick overview of Lebanon Explorer.
            </p>

        </div>



        <div
            class="grid grid-cols-1
                   md:grid-cols-3
                   gap-6"
        >


            {{-- TOTAL PLACES --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       p-6
                       shadow-sm"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 font-medium">
                            Total Places
                        </p>


                        <p
                            class="text-4xl
                                   font-bold
                                   text-gray-900
                                   mt-3"
                        >
                            {{ $totalPlaces }}
                        </p>

                    </div>


                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-green-100
                               flex items-center
                               justify-center
                               text-green-700
                               text-xl
                               font-bold"
                    >
                        P
                    </div>

                </div>

            </div>



            {{-- TOTAL CATEGORIES --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       p-6
                       shadow-sm"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 font-medium">
                            Categories
                        </p>


                        <p
                            class="text-4xl
                                   font-bold
                                   text-gray-900
                                   mt-3"
                        >
                            {{ $totalCategories }}
                        </p>

                    </div>


                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-blue-100
                               flex items-center
                               justify-center
                               text-blue-700
                               text-xl
                               font-bold"
                    >
                        C
                    </div>

                </div>

            </div>



            {{-- FEATURED --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       p-6
                       shadow-sm"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-500 font-medium">
                            Featured Places
                        </p>


                        <p
                            class="text-4xl
                                   font-bold
                                   text-gray-900
                                   mt-3"
                        >
                            {{ $featuredCount }}
                        </p>

                    </div>


                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-yellow-100
                               flex items-center
                               justify-center
                               text-yellow-700
                               text-xl
                               font-bold"
                    >
                        ★
                    </div>

                </div>

            </div>


        </div>

    </section>



    {{-- =========================================================
         FEATURED DESTINATIONS
    ========================================================== --}}
    <section class="mb-14">


        {{-- SECTION HEADER --}}
        <div
            class="flex items-end
                   justify-between
                   gap-4
                   mb-6"
        >

            <div>

                <h2 class="text-2xl font-bold text-gray-900">
                    Featured Destinations
                </h2>

                <p class="text-gray-500 mt-1">
                    Highlighted places worth discovering.
                </p>

            </div>


            <a
                href="{{ route('places.index') }}"
                class="text-green-700
                       font-semibold
                       hover:text-green-800"
            >
                View All
            </a>

        </div>



        {{-- FEATURED CARDS --}}
        <div
            class="grid grid-cols-1
                   md:grid-cols-2
                   lg:grid-cols-3
                   gap-8"
        >


            @forelse ($featuredPlaces as $place)


                <div
                    class="bg-white
                           rounded-2xl
                           overflow-hidden
                           border border-gray-200
                           shadow-sm"
                >


                    {{-- IMAGE --}}
                    @if ($place->image)

                        <img
                            src="{{ asset('storage/' . $place->image) }}"
                            alt="{{ $place->name }}"
                            class="w-full h-56 object-cover"
                        >

                    @else

                        <img
                            src="{{ asset('images/place-placeholder.jpg') }}"
                            alt="Place placeholder"
                            class="w-full h-56 object-cover"
                        >

                    @endif



                    {{-- CONTENT --}}
                    <div class="p-6">


                        {{-- CATEGORY --}}
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



                        {{-- NAME --}}
                        <h3
                            class="text-xl
                                   font-bold
                                   text-gray-900
                                   mt-4"
                        >
                            {{ $place->name }}
                        </h3>



                        {{-- REGION --}}
                        <p class="text-gray-500 mt-2">
                            {{ $place->region }}
                        </p>



                        {{-- DESCRIPTION --}}
                        <p
                            class="text-gray-600
                                   mt-4
                                   leading-relaxed"
                        >
                            {{ \Illuminate\Support\Str::limit($place->description, 100) }}
                        </p>



                        {{-- ENTRY FEE --}}
                        <div
                            class="mt-5
                                   pt-4
                                   border-t
                                   border-gray-100"
                        >

                            <p class="text-sm text-gray-500">
                                Entry Fee
                            </p>


                            <p
                                class="font-bold
                                       text-gray-900
                                       mt-1"
                            >

                                @if ($place->entry_fee !== null)

                                    ${{ number_format($place->entry_fee, 2) }}

                                @else

                                    Free / Not specified

                                @endif

                            </p>

                        </div>


                    </div>

                </div>


            @empty


                <div
                    class="md:col-span-2
                           lg:col-span-3
                           bg-white
                           border border-gray-200
                           rounded-2xl
                           p-10
                           text-center"
                >

                    <h3 class="font-bold text-gray-900">
                        No featured destinations yet
                    </h3>


                    <p class="text-gray-500 mt-2">
                        Mark a place as featured and it will appear here.
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
                   rounded-2xl
                   border border-gray-200
                   shadow-sm
                   overflow-hidden"
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
                           last:border-b-0"
                >


                    {{-- IMAGE --}}
                    @if ($place->image)

                        <img
                            src="{{ asset('storage/' . $place->image) }}"
                            alt="{{ $place->name }}"
                            class="w-full
                                   sm:w-24
                                   h-24
                                   object-cover
                                   rounded-xl"
                        >

                    @else

                        <img
                            src="{{ asset('images/place-placeholder.jpg') }}"
                            alt="Place placeholder"
                            class="w-full
                                   sm:w-24
                                   h-24
                                   object-cover
                                   rounded-xl"
                        >

                    @endif



                    {{-- PLACE INFO --}}
                    <div class="flex-1">


                        <h3
                            class="text-lg
                                   font-bold
                                   text-gray-900"
                        >
                            {{ $place->name }}
                        </h3>


                        <p class="text-gray-500 mt-1">
                            {{ $place->region }}
                        </p>


                        <p
                            class="text-gray-600
                                   text-sm
                                   mt-2"
                        >
                            {{ \Illuminate\Support\Str::limit($place->description, 90) }}
                        </p>


                    </div>



                    {{-- CATEGORY --}}
                    <div>

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


                <div class="p-10 text-center">

                    <h3 class="font-bold text-gray-900">
                        No places yet
                    </h3>


                    <p class="text-gray-500 mt-2">
                        Add your first destination from the Places page.
                    </p>

                </div>


            @endforelse


        </div>

    </section>


@endsection