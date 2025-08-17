<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Property;
use App\Models\PropertyPhoto;

class PropertyController extends Controller
{
    public function index(): View
    {
        $properties = Property::with(['coverPhoto', 'photos'])->orderBy('created_at', 'desc')->get();
        return view('admin.properties.index', compact('properties'));
    }

    public function create(): View
    {
        return view('admin.properties.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'type' => 'required|in:vendite,affitti',
                'disponibilita' => 'nullable|string|max:255',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:6144',
                'cover_image' => 'required|integer|min:0',
                'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB max for PDF
            ]);

            $property = Property::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'type' => $validated['type'],
                'disponibilita' => $validated['disponibilita'],
            ]);

            // Handle PDF upload
            if ($request->hasFile('pdf_file')) {
                $pdfFilename = uniqid('property_').'.pdf';
                $request->file('pdf_file')->move(public_path('pdfs/properties'), $pdfFilename);
                $property->update(['pdf_path' => '/pdfs/properties/'.$pdfFilename]);
            }

            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $filename = uniqid('property_').'_'.$index.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('images/properties'), $filename);

                    PropertyPhoto::create([
                        'property_id' => $property->id,
                        'image_path' => '/images/properties/'.$filename,
                        'is_cover' => $index == $validated['cover_image'],
                        'order' => $index,
                    ]);
                }
            }

            return redirect()->route('admin.properties.index')->with('status', 'Immobile aggiunto con successo!');
        } catch (\Exception $e) {
            \Log::error('Property creation error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->withErrors(['error' => 'Errore durante la creazione: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Property $property): View
    {
        $property->load('photos');
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'type' => 'required|in:vendite,affitti',
                'disponibilita' => 'nullable|string|max:255',
                'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:6144',
                'cover_photo_id' => 'nullable|exists:property_photos,id',
                'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB max for PDF
            ]);

            $data = [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'type' => $validated['type'],
                'disponibilita' => $validated['disponibilita'],
            ];

            // Handle PDF upload
            if ($request->hasFile('pdf_file')) {
                // Delete old PDF if exists
                if ($property->pdf_path && file_exists(public_path($property->pdf_path))) {
                    unlink(public_path($property->pdf_path));
                }

                $pdfFilename = uniqid('property_').'.pdf';
                $request->file('pdf_file')->move(public_path('pdfs/properties'), $pdfFilename);
                $data['pdf_path'] = '/pdfs/properties/'.$pdfFilename;
            }

            $property->update($data);

            // Handle cover photo selection
            if ($validated['cover_photo_id']) {
                $property->photos()->update(['is_cover' => false]);
                $property->photos()->where('id', $validated['cover_photo_id'])->update(['is_cover' => true]);
            }

            // Handle new image uploads
            if ($request->hasFile('new_images')) {
                $maxOrder = $property->photos()->max('order') ?? -1;
                
                foreach ($request->file('new_images') as $image) {
                    $maxOrder++;
                    $filename = uniqid('property_').'_'.$maxOrder.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('images/properties'), $filename);

                    PropertyPhoto::create([
                        'property_id' => $property->id,
                        'image_path' => '/images/properties/'.$filename,
                        'is_cover' => false,
                        'order' => $maxOrder,
                    ]);
                }
            }

            return redirect()->route('admin.properties.index')->with('status', 'Immobile aggiornato con successo!');
        } catch (\Exception $e) {
            \Log::error('Property update error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->withErrors(['error' => 'Errore durante l\'aggiornamento: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Property $property): RedirectResponse
    {
        // Delete all associated photos
        foreach ($property->photos as $photo) {
            if (file_exists(public_path($photo->image_path))) {
                unlink(public_path($photo->image_path));
            }
        }
        
        // Delete PDF file if exists
        if ($property->pdf_path && file_exists(public_path($property->pdf_path))) {
            unlink(public_path($property->pdf_path));
        }
        
        $property->delete();

        return redirect()->route('admin.properties.index')->with('status', 'Immobile eliminato con successo!');
    }

    public function deletePhoto(PropertyPhoto $photo): RedirectResponse
    {
        $property = $photo->property;
        
        // Delete image file
        if (file_exists(public_path($photo->image_path))) {
            unlink(public_path($photo->image_path));
        }

        $photo->delete();

        // If this was the cover photo, make the first remaining photo the cover
        if ($property->photos()->count() > 0) {
            $property->photos()->first()->update(['is_cover' => true]);
        }

        return redirect()->route('admin.properties.edit', $property)->with('status', 'Foto eliminata con successo!');
    }


} 