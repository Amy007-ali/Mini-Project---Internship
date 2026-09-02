@extends('layouts.app')

@section('title', 'Places')

@section('content')

    <div class="mb-8">

        <h1 class="text-3xl font-bold">
            Places
        </h1>

        <p class="text-gray-600 mt-2">
            Manage tourist attractions across Lebanon.
        </p>

    </div>


    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">

        <h2 class="text-xl font-semibold mb-5">
            Add Place
        </h2>

        <form action="{{ route('places.store') }}"
              method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                <div>

                    <label class="block font-medium mb-2">
                        Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">

                </div>


                <div>

                    <label class="block font-medium mb-2">
                        Region
                    </label>

                    <input type="text"
                           name="region"
                           value="{{ old('region') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">

                </div>


                <div>

                    <label class="block font-medium mb-2">
                        Category
                    </label>

                    <select name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2">

                        <option value="">
                            Select Category
                        </option>

                        @foreach ($categories as $category)

                            <option value="{{ $category->id }}">

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block font-medium mb-2">
                        Entry Fee
                    </label>

                    <input type="number"
                           step="0.01"
                           name="entry_fee"
                           value="{{ old('entry_fee') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2">

                </div>

            </div>


            <div class="mt-4">

                <label class="block font-medium mb-2">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('description') }}</textarea>

            </div>


            <div class="mt-4 flex items-center gap-2">

                <input type="checkbox"
                       name="is_featured"
                       value="1">

                <label>
                    Featured Place
                </label>

            </div>


            <button type="submit"
                    class="mt-5 bg-green-700 text-white px-5 py-2 rounded-lg hover:bg-green-800">

                Add Place

            </button>

        </form>

    </div>


    <form method="GET"
          action="{{ route('places.index') }}"
          class="bg-white rounded-xl border border-gray-200 p-4 mb-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search by name or region..."
                   class="border border-gray-300 rounded-lg px-4 py-2">


            <select name="category_id"
                    class="border border-gray-300 rounded-lg px-4 py-2">

                <option value="">
                    All Categories
                </option>

                @foreach ($categories as $category)

                    <option value="{{ $category->id }}"
                        @selected(request('category_id') == $category->id)>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>


            <button type="submit"
                    class="bg-gray-900 text-white rounded-lg px-4 py-2">

                Filter

            </button>

        </div>

    </form>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($places as $place)

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">

                <div class="flex items-start justify-between gap-4">

                    <h3 class="text-xl font-bold">
                        {{ $place->name }}
                    </h3>

                    @if ($place->is_featured)

                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">

                            Featured

                        </span>

                    @endif

                </div>


                <p class="text-gray-500 mt-2">
                    {{ $place->region }}
                </p>


                <p class="text-green-700 font-semibold mt-2">

                    {{ $place->category->name }}

                </p>


                <p class="text-gray-600 mt-4">
                    {{ $place->description }}
                </p>


                <p class="font-semibold mt-4">

                    Entry Fee:

                    @if ($place->entry_fee !== null)

                        ${{ number_format($place->entry_fee, 2) }}

                    @else

                        Free / Not specified

                    @endif

                </p>


                <form action="{{ route('places.update', $place) }}"
                      method="POST"
                      class="mt-6 border-t pt-5">

                    @csrf
                    @method('PUT')


                    <input type="text"
                           name="name"
                           value="{{ $place->name }}"
                           class="w-full border rounded-lg px-3 py-2 mb-2">


                    <input type="text"
                           name="region"
                           value="{{ $place->region }}"
                           class="w-full border rounded-lg px-3 py-2 mb-2">


                    <select name="category_id"
                            class="w-full border rounded-lg px-3 py-2 mb-2">

                        @foreach ($categories as $category)

                            <option value="{{ $category->id }}"
                                @selected($place->category_id === $category->id)>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>


                    <input type="number"
                           step="0.01"
                           name="entry_fee"
                           value="{{ $place->entry_fee }}"
                           class="w-full border rounded-lg px-3 py-2 mb-2">


                    <textarea name="description"
                              rows="3"
                              class="w-full border rounded-lg px-3 py-2 mb-2">{{ $place->description }}</textarea>


                    <label class="flex items-center gap-2 mb-3">

                        <input type="checkbox"
                               name="is_featured"
                               value="1"
                               @checked($place->is_featured)>

                        Featured

                    </label>


                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg">

                        Update

                    </button>

                </form>


                <form action="{{ route('places.destroy', $place) }}"
                      method="POST"
                      class="mt-3">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this place?')"
                            class="text-red-600 hover:text-red-800">

                        Delete

                    </button>

                </form>

            </div>

        @empty

            <p class="text-gray-500">
                No places found.
            </p>

        @endforelse

    </div>

@endsection