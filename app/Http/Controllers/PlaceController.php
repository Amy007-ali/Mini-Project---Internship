<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display all places.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')
            ->get();

        $places = Place::with('category')

            ->when($request->search, function ($query, $search) {

                $query->where(function ($query) use ($search) {

                    $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('region', 'like', '%' . $search . '%');

                });

            })

            ->when($request->category_id, function ($query, $categoryId) {

                $query->where('category_id', $categoryId);

            })

            ->latest()
            ->get();


        return view('places.index', compact(
            'places',
            'categories'
        ));
    }


    /**
     * Store a new place.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',

            'entry_fee' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        $validated['is_featured'] =
            $request->boolean('is_featured');


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        |
        | The actual image goes into:
        |
        | storage/app/public/places/
        |
        | The database only stores its relative path.
        |
        */

        if ($request->hasFile('image')) {

            $validated['image'] =
                $request
                    ->file('image')
                    ->store('places', 'public');

        }


        Place::create($validated);


        return redirect()
            ->route('places.index')
            ->with(
                'success',
                'Place added successfully.'
            );
    }


    /**
     * Update an existing place.
     */
    public function update(
        Request $request,
        Place $place
    ) {

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',

            'entry_fee' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        $validated['is_featured'] =
            $request->boolean('is_featured');


        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        |
        | Only replace the image if the user selected a new one.
        |
        */

        if ($request->hasFile('image')) {


            /*
             * Delete old uploaded image.
             */
            if ($place->image) {

                Storage::disk('public')
                    ->delete($place->image);

            }


            /*
             * Store new image.
             */
            $validated['image'] =
                $request
                    ->file('image')
                    ->store('places', 'public');

        }


        $place->update($validated);


        return redirect()
            ->route('places.index')
            ->with(
                'success',
                'Place updated successfully.'
            );
    }


    /**
     * Delete a place.
     */
    public function destroy(Place $place)
    {
        /*
         * Delete the uploaded image first.
         */
        if ($place->image) {

            Storage::disk('public')
                ->delete($place->image);

        }


        /*
         * Delete the database record.
         */
        $place->delete();


        return redirect()
            ->route('places.index')
            ->with(
                'success',
                'Place deleted successfully.'
            );
    }
}