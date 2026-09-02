@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="mb-10">

        <h1 class="text-3xl font-bold text-gray-900">
            Categories
        </h1>

        <p class="text-gray-600 mt-2">
            Organize Lebanon's destinations into meaningful categories.
        </p>

    </div>


    {{-- =========================================================
         ADD CATEGORY
    ========================================================== --}}
    <section class="mb-12">

        <div
            class="bg-white
                   border border-gray-200
                   rounded-2xl
                   shadow-sm
                   p-6 md:p-8"
        >

            <div class="mb-6">

                <h2 class="text-xl font-bold text-gray-900">
                    Add Category
                </h2>

                <p class="text-gray-500 mt-1">
                    Create a category for organizing destinations.
                </p>

            </div>


            <form
                action="{{ route('categories.store') }}"
                method="POST"
            >

                @csrf


                <div
                    class="flex flex-col
                           md:flex-row
                           gap-4"
                >

                    <div class="flex-1">

                        <label class="block font-medium text-gray-700 mb-2">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Example: Historical"
                            class="w-full
                                   border border-gray-300
                                   rounded-lg
                                   px-4 py-3
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-green-600"
                        >

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div class="md:self-end">

                        <button
                            type="submit"
                            class="w-full md:w-auto
                                   bg-green-700
                                   text-white
                                   px-7 py-3
                                   rounded-lg
                                   font-semibold
                                   hover:bg-green-800
                                   transition"
                        >
                            Add Category
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </section>


    {{-- =========================================================
         CATEGORY LIST
    ========================================================== --}}
    <section>

        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-900">
                All Categories
            </h2>

            <p class="text-gray-500 mt-1">
                View and manage your destination categories.
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($categories as $category)

                <article
                    class="bg-white
                           border border-gray-200
                           rounded-2xl
                           p-6
                           shadow-sm
                           hover:shadow-md
                           transition"
                >

                    {{-- TOP --}}
                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $category->name }}
                            </h3>


                            <p class="text-gray-500 mt-2">

                                {{ $category->places_count }}

                                {{ $category->places_count == 1 ? 'Place' : 'Places' }}

                            </p>

                        </div>


                        <div
                            class="w-11 h-11
                                   rounded-xl
                                   bg-green-100
                                   text-green-700
                                   flex items-center
                                   justify-center
                                   font-bold"
                        >
                            {{ strtoupper(substr($category->name, 0, 1)) }}
                        </div>

                    </div>


                    {{-- EDIT --}}
                    <div class="mt-6 pt-5 border-t border-gray-100">

                        <form
                            action="{{ route('categories.update', $category) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PUT')


                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Rename Category
                            </label>


                            <div class="flex gap-2">

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ $category->name }}"
                                    class="min-w-0
                                           flex-1
                                           border border-gray-300
                                           rounded-lg
                                           px-3 py-2
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-blue-500"
                                >


                                <button
                                    type="submit"
                                    class="bg-blue-600
                                           text-white
                                           px-4 py-2
                                           rounded-lg
                                           font-semibold
                                           hover:bg-blue-700
                                           transition"
                                >
                                    Update
                                </button>

                            </div>

                        </form>


                        {{-- DELETE --}}
                        <form
                            action="{{ route('categories.destroy', $category) }}"
                            method="POST"
                            class="mt-3"
                        >

                            @csrf
                            @method('DELETE')


                            <button
                                type="submit"
                                onclick="return confirm('Are you sure you want to delete {{ $category->name }}?')"
                                class="w-full
                                       border border-red-200
                                       text-red-600
                                       px-4 py-2
                                       rounded-lg
                                       font-semibold
                                       hover:bg-red-50
                                       transition"
                            >
                                Delete Category
                            </button>

                        </form>

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
                        🗂️
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mt-4">
                        No categories yet
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Create your first category above.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

@endsection