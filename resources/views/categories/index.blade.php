@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold">
                Categories
            </h1>

            <p class="text-gray-600 mt-2">
                Organize tourist destinations into categories.
            </p>
        </div>

    </div>


    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">

        <h2 class="text-xl font-semibold mb-4">
            Add Category
        </h2>

        <form action="{{ route('categories.store') }}"
              method="POST">

            @csrf

            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Name
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2">

                @error('name')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Description
                </label>

                <textarea name="description"
                          rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('description') }}</textarea>

            </div>


            <button type="submit"
                    class="bg-green-700 text-white px-5 py-2 rounded-lg hover:bg-green-800">

                Add Category

            </button>

        </form>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($categories as $category)

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <h3 class="text-xl font-bold">
                    {{ $category->name }}
                </h3>

                <p class="text-gray-600 mt-2">
                    {{ $category->description ?: 'No description.' }}
                </p>

                <p class="mt-4 font-semibold text-green-700">
                    {{ $category->places_count }}
                    {{ $category->places_count === 1 ? 'Place' : 'Places' }}
                </p>


                <form action="{{ route('categories.update', $category) }}"
                      method="POST"
                      class="mt-6">

                    @csrf
                    @method('PUT')

                    <input type="text"
                           name="name"
                           value="{{ $category->name }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-2">

                    <textarea name="description"
                              rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-3">{{ $category->description }}</textarea>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Update
                    </button>

                </form>


                <form action="{{ route('categories.destroy', $category) }}"
                      method="POST"
                      class="mt-3">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this category?')"
                            class="text-red-600 hover:text-red-800">

                        Delete

                    </button>

                </form>

            </div>

        @empty

            <p class="text-gray-500">
                No categories found.
            </p>

        @endforelse

    </div>

@endsection