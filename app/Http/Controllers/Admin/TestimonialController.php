<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'testimonials');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                $this->deleteImageDirect($testimonial->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'testimonials');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            $this->deleteImageDirect($testimonial->image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
