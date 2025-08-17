<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\PropertyInquiry;
use App\Models\Property;

class ContactController extends Controller
{
    public function submit(Request $request): RedirectResponse
    {
        // Validate the form data
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Get the property details
        $property = Property::findOrFail($validated['property_id']);

        // Prepare data for email
        $inquiryData = [
            'property_title' => $property->title,
            'property_type' => $property->type,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ];

        // Send email
        try {
            Mail::to('juriken17grgic@gmail.com')->send(new PropertyInquiry($inquiryData));
            
            return back()->with('success', 'Messaggio inviato con successo! Ti contatteremo presto.');
        } catch (\Exception $e) {
            return back()->with('error', 'Errore nell\'invio del messaggio. Riprova più tardi.');
        }
    }

    public function submitQuote(Request $request): RedirectResponse
    {
        // Validate the form data
        $validated = $request->validate([
            'service_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Prepare data for email
        $quoteData = [
            'service_type' => $validated['service_type'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ];

        // Send email
        try {
            Mail::to('juriken17grgic@gmail.com')->send(new PropertyInquiry($quoteData));
            
            return back()->with('success', 'Richiesta di preventivo inviata con successo! Ti contatteremo presto.');
        } catch (\Exception $e) {
            return back()->with('error', 'Errore nell\'invio della richiesta. Riprova più tardi.');
        }
    }
} 