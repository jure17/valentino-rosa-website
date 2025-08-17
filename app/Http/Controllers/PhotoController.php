<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index(): View
    {
        $photos = Photo::orderBy('order')->orderBy('created_at', 'desc')->get();
        $categories = Photo::getCategories();
        
        return view('admin.photos.index', compact('photos', 'categories'));
    }

    public function create(): View
    {
        $categories = Photo::getCategories();
        return view('admin.photos.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'required|in:soprastrutture,sottostrutture,muri,mezzi',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:6144',
            'order' => 'nullable|integer|min:0',
        ]);

        $filename = uniqid('photo_').'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/fratelli-rosa'), $filename);

        Photo::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image_path' => '/images/fratelli-rosa/'.$filename,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.photos.index')->with('status', 'Foto aggiunta con successo!');
    }

    public function edit(Photo $photo): View
    {
        $categories = Photo::getCategories();
        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, Photo $photo): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'required|in:soprastrutture,sottostrutture,muri,mezzi',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'order' => $validated['order'] ?? $photo->order,
        ];

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path($photo->image_path))) {
                unlink(public_path($photo->image_path));
            }

            $filename = uniqid('photo_').'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/fratelli-rosa'), $filename);
            $data['image_path'] = '/images/fratelli-rosa/'.$filename;
        }

        $photo->update($data);

        return redirect()->route('admin.photos.index')->with('status', 'Foto aggiornata con successo!');
    }

    public function destroy(Photo $photo): RedirectResponse
    {
        // Delete image file
        if (file_exists(public_path($photo->image_path))) {
            unlink(public_path($photo->image_path));
        }

        $photo->delete();

        return redirect()->route('admin.photos.index')->with('status', 'Foto eliminata con successo!');
    }
} 