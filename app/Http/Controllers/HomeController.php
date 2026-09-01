<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        // Fitur Filter Kategori
        $query = Gallery::with('category')->latest();
        
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $galleries = $query->paginate(12);

        return view('welcome', compact('galleries', 'categories'));
    }
}