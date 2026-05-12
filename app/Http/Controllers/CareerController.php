<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Career;
use App\Http\Controllers\Admin\HandlesDirectImageUploads;

class CareerController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $careers = Career::where('is_open', true)->latest()->get();
        return view('careers.index', compact('careers'));
    }

    public function show($id)
    {
        $career = Career::findOrFail($id);
        $contact_email = \App\Models\Setting::where('key', 'contact_email')->value('value') ?? 'careers@deventtechnology.com';
        return view('careers.show', compact('career', 'contact_email'));
    }

    public function storeApplication(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'nullable|string',
        ]);

        $resumePath = $this->uploadImageDirect($request->file('resume'), 'resumes');

        \App\Models\JobApplication::create([
            'career_id' => $career->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter,
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }
}
