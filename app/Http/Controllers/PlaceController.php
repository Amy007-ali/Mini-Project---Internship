<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request) {
        $categories = Category::orderBy('name')->get();

        $places = Place::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('region', 'like', '%' . $search . '%');
                });
            })
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->get();

        return view('places.index', compact('places', 'categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'entry_fee' => 'nullable|numeric|min:0',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        Place::create($validated);

        return redirect()
            ->route('places.index')
            ->with('success', 'Place added successfully.');
    }

    public function update(Request $request, Place $place) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'entry_fee' => 'nullable|numeric|min:0',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $place->update($validated);

        return redirect()
            ->route('places.index')
            ->with('success', 'Place updated successfully.');
    }

    public function destroy(Place $place) {
        $place->delete();

        return redirect()
            ->route('places.index')
            ->with('success', 'Place deleted successfully.');
    }
}