<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inquiry;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create($validated);

        return back()->with('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    }
}
