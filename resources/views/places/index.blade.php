@extends('layouts.app')

@section('title', 'Places')

@section('content')

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="mb-10">

        <h1 class="text-3xl font-bold text-gray-900">
            Places
        </h1>

        <p class="text-gray-600 mt-2">
            Manage tourist attractions across Lebanon.
        </p>

    </div>


    {{-- =========================================================
         ADD PLACE SECTION
    ========================================================== --}}
    <section class="mb-16">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

            <div class="mb-7">

                <h2 class="text-2xl font-bold text-gray-900">
                    Add Place
                </h2>

                <p class="text-gray-500 mt-1">
                    Add a new tourist destination to Lebanon Explorer.
                </p>

            </div>


            <form
                action="{{ route('places.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- NAME + REGION --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAME --}}
                    <div>

                        <label class="block font-medium text-gray-700 mb-2">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Example: Jeita Grotto"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-green-600
                                   focus:border-transparent"
                        >

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- REGION --}}
                    <div>

                        <label class="block font-medium text-gray-700 mb-2">
                            Region
                        </label>

                        <input
                            type="text"
                            name="region"
                            value="{{ old('region') }}"
                            placeholder="Example: Keserwan"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-green-600
                                   focus:border-transparent"
                        >

                        @error('region')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- CATEGORY + ENTRY FEE --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                    {{-- CATEGORY --}}
                    <div>

                        <label class="block font-medium text-gray-700 mb-2">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-green-600
                                   focus:border-transparent"
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- ENTRY FEE --}}
                    <div>

                        <label class="block font-medium text-gray-700 mb-2">
                            Entry Fee
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="entry_fee"
                            value="{{ old('entry_fee') }}"
                            placeholder="Example: 10"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-green-600
                                   focus:border-transparent"
                        >

                        @error('entry_fee')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- DESCRIPTION --}}
                <div class="mt-6">

                    <label class="block font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Write a short description about the place..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3
                               focus:outline-none focus:ring-2 focus:ring-green-600
                               focus:border-transparent"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- IMAGE --}}
                <div class="mt-6">

                    <label class="block font-medium text-gray-700 mb-2">
                        Place Image
                    </label>

                    <div class="flex items-center gap-4 flex-wrap">

                        <input
                            type="file"
                            name="image"
                            id="placeImage"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="hidden"
                            onchange="
                                document.getElementById('addImageName').textContent =
                                this.files.length
                                    ? this.files[0].name
                                    : 'No file chosen'
                            "
                        >

                        <label
                            for="placeImage"
                            class="inline-flex items-center justify-center
                                   bg-blue-600 text-white
                                   px-5 py-2.5 rounded-lg
                                   font-medium cursor-pointer
                                   hover:bg-blue-700 transition"
                        >
                            Choose Image
                        </label>

                        <span
                            id="addImageName"
                            class="text-gray-500 text-sm"
                        >
                            No file chosen
                        </span>

                    </div>


                    <p class="text-sm text-gray-500 mt-2">
                        Accepted: JPG, JPEG, PNG, WEBP. Maximum size: 2MB.
                    </p>


                    @error('image')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- FEATURED --}}
                <div class="mt-6">

                    <label class="inline-flex items-center gap-3 cursor-pointer">

                        <input
                            type="checkbox"
                            name="is_featured"
                            value="1"
                            @checked(old('is_featured'))
                            class="w-4 h-4"
                        >

                        <span class="font-medium text-gray-700">
                            Featured Place
                        </span>

                    </label>

                </div>


                {{-- ADD BUTTON --}}
                <div class="mt-8">

                    <button
                        type="submit"
                        class="bg-green-700 text-white
                               px-7 py-3 rounded-lg
                               font-medium
                               hover:bg-green-800 transition"
                    >
                        Add Place
                    </button>

                </div>

            </form>

        </div>

    </section>


    {{-- =========================================================
         EXPLORE PLACES
         ID ADDED SO SEARCH RETURNS HERE
    ========================================================== --}}
    <section id="explore-places" class="scroll-mt-8">

        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-900">
                Explore Places
            </h2>

            <p class="text-gray-500 mt-1">
                Search, filter, edit, or remove existing destinations.
            </p>

        </div>


        {{-- =====================================================
             SEARCH & FILTER
        ====================================================== --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-10">

            <form
                action="{{ route('places.index') }}#explore-places"
                method="GET"
            >

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- SEARCH --}}
                    <div>

                        <label class="block font-medium text-gray-700 mb-2">
                            Search Places
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by name or region..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-green-600
                                   focus:border-transparent"
                        >

                    </div>


                    {{-- CATEGORY --}}
                    <div>

                        <label class="block font-medium text-gray-700 mb-2">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3
                                   focus:outline-none focus:ring-2 focus:ring-green-600
                                   focus:border-transparent"
                        >

                            <option value="">
                                All Categories
                            </option>

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(request('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- BUTTONS --}}
                    <div class="flex items-end gap-3">

                        <button
                            type="submit"
                            class="flex-1 bg-gray-900 text-white
                                   px-5 py-3 rounded-lg
                                   font-medium
                                   hover:bg-gray-800 transition"
                        >
                            Search
                        </button>


                        <a
                            href="{{ route('places.index') }}#explore-places"
                            class="px-5 py-3 rounded-lg
                                   border border-gray-300
                                   text-gray-700 font-medium
                                   hover:bg-gray-100 transition"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        {{-- =====================================================
             PLACES GRID
        ====================================================== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse ($places as $place)

                <div
                    class="bg-white rounded-2xl overflow-hidden
                           border border-gray-200 shadow-sm"
                >

                    {{-- PLACE IMAGE --}}
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


                    {{-- CARD CONTENT --}}
                    <div class="p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h3 class="text-xl font-bold text-gray-900">
                                    {{ $place->name }}
                                </h3>

                                <p class="text-gray-500 mt-1">
                                    {{ $place->region }}
                                </p>

                            </div>


                            @if ($place->is_featured)

                                <span
                                    class="shrink-0
                                           bg-yellow-100 text-yellow-800
                                           text-xs font-semibold
                                           px-3 py-1 rounded-full"
                                >
                                    Featured
                                </span>

                            @endif

                        </div>


                        {{-- CATEGORY --}}
                        <span
                            class="inline-block mt-4
                                   bg-green-100 text-green-800
                                   text-sm font-medium
                                   px-3 py-1 rounded-full"
                        >
                            {{ $place->category->name }}
                        </span>


                        {{-- DESCRIPTION --}}
                        <p class="text-gray-600 mt-4 leading-relaxed">
                            {{ $place->description }}
                        </p>


                        {{-- ENTRY FEE --}}
                        <div class="mt-5">

                            <p class="text-sm text-gray-500">
                                Entry Fee
                            </p>

                            <p class="font-bold text-gray-900 mt-1">

                                @if ($place->entry_fee !== null)

                                    ${{ number_format($place->entry_fee, 2) }}

                                @else

                                    Free / Not specified

                                @endif

                            </p>

                        </div>


                        {{-- =================================================
                             EDIT PLACE
                        ================================================== --}}
                        <div class="mt-7 pt-6 border-t border-gray-200">

                            <h4 class="text-lg font-bold text-gray-900 mb-5">
                                Edit Place
                            </h4>


                            <form
                                action="{{ route('places.update', $place) }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >

                                @csrf
                                @method('PUT')


                                {{-- NAME --}}
                                <div class="mb-4">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Name
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $place->name }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                                               focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >

                                </div>


                                {{-- REGION --}}
                                <div class="mb-4">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Region
                                    </label>

                                    <input
                                        type="text"
                                        name="region"
                                        value="{{ $place->region }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                                               focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >

                                </div>


                                {{-- CATEGORY --}}
                                <div class="mb-4">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Category
                                    </label>

                                    <select
                                        name="category_id"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                                               focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >

                                        @foreach ($categories as $category)

                                            <option
                                                value="{{ $category->id }}"
                                                @selected($place->category_id == $category->id)
                                            >
                                                {{ $category->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- ENTRY FEE --}}
                                <div class="mb-4">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Entry Fee
                                    </label>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        name="entry_fee"
                                        value="{{ $place->entry_fee }}"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                                               focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >

                                </div>


                                {{-- DESCRIPTION --}}
                                <div class="mb-5">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Description
                                    </label>

                                    <textarea
                                        name="description"
                                        rows="4"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                                               focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >{{ $place->description }}</textarea>

                                </div>


                                {{-- CHANGE IMAGE --}}
                                <div class="mb-5">

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Change Image
                                    </label>


                                    <div class="flex items-center gap-3 flex-wrap">

                                        <input
                                            type="file"
                                            name="image"
                                            id="editImage{{ $place->id }}"
                                            accept="image/jpeg,image/png,image/jpg,image/webp"
                                            class="hidden"
                                            onchange="
                                                document.getElementById('editImageName{{ $place->id }}').textContent =
                                                this.files.length
                                                    ? this.files[0].name
                                                    : 'No file chosen'
                                            "
                                        >


                                        <label
                                            for="editImage{{ $place->id }}"
                                            class="inline-flex items-center justify-center
                                                   bg-blue-600 text-white
                                                   px-4 py-2.5 rounded-lg
                                                   text-sm font-medium
                                                   cursor-pointer
                                                   hover:bg-blue-700 transition"
                                        >
                                            Choose Image
                                        </label>


                                        <span
                                            id="editImageName{{ $place->id }}"
                                            class="text-gray-500 text-sm"
                                        >
                                            No file chosen
                                        </span>

                                    </div>


                                    <p class="text-xs text-gray-500 mt-2">
                                        Leave empty to keep the existing image.
                                    </p>

                                </div>


                                {{-- FEATURED --}}
                                <div class="mb-5">

                                    <label class="inline-flex items-center gap-2 cursor-pointer">

                                        <input
                                            type="checkbox"
                                            name="is_featured"
                                            value="1"
                                            @checked($place->is_featured)
                                        >

                                        <span class="text-sm font-medium text-gray-700">
                                            Featured Place
                                        </span>

                                    </label>

                                </div>


                                {{-- UPDATE --}}
                                <button
                                    type="submit"
                                    class="w-full
                                           bg-blue-600 text-white
                                           px-4 py-2.5 rounded-lg
                                           font-medium
                                           hover:bg-blue-700 transition"
                                >
                                    Update Place
                                </button>

                            </form>


                            {{-- DELETE --}}
                            <form
                                action="{{ route('places.destroy', $place) }}"
                                method="POST"
                                class="mt-3"
                            >

                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete {{ $place->name }}?')"
                                    class="w-full
                                           border border-red-200
                                           text-red-600
                                           px-4 py-2.5 rounded-lg
                                           font-medium
                                           hover:bg-red-50 transition"
                                >
                                    Delete Place
                                </button>

                            </form>

                        </div>

                    </div>

                </div>


            @empty

                {{-- NO RESULTS --}}
                <div
                    class="md:col-span-2 lg:col-span-3
                           bg-white border border-gray-200
                           rounded-2xl p-12 text-center"
                >

                    <h3 class="text-xl font-bold text-gray-900">
                        No places found
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Try another search or change the category filter.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

@endsection