<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Property;

class ValentinoController extends Controller
{
    public function index(Request $request) : View {
        $filter = $request->query('filter');
        $query = Property::with(['coverPhoto', 'photos']);
        if (in_array($filter, ['affitti','vendite'])) {
            $query->where('type', $filter);
        }
        $properties = $query->latest()->get();
        return view('valentino-rosa.main', compact('properties'));
    }
}
