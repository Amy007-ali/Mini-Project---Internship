<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Place;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPlaces = Place::count();

        $totalCategories = Category::count();

        $featuredCount = Place::where('is_featured', true)->count();

        $featuredPlaces = Place::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $recentPlaces = Place::with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('dashboard.index', compact(
            'totalPlaces',
            'totalCategories',
            'featuredCount',
            'featuredPlaces',
            'recentPlaces'
        ));
    }
}