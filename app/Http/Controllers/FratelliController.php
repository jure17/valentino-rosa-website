<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Photo;

class FratelliController extends Controller
{
    public function index(): View
    {
        $photos = Photo::orderBy('order')->orderBy('created_at', 'desc')->get();
        
        // Group photos by category
        $photosByCategory = [
            'tutte' => $photos, // Show all photos in "tutte le foto"
            'soprastrutture' => $photos->where('category', 'soprastrutture'),
            'sottostrutture' => $photos->where('category', 'sottostrutture'),
            'muri' => $photos->where('category', 'muri'),
            'mezzi' => $photos->where('category', 'mezzi'),
        ];
        
        return view('fratelli-rosa.main', compact('photosByCategory'));
    }
}
