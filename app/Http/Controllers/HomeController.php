<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 galeri terbaru
        $galleries = Gallery::with('category')->latest()->take(6)->get();

        return view('welcome', compact('galleries'));
    }
}