<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->paginate(10);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_open' => 'boolean',
        ]);

        Career::create($request->all());

        return redirect()->route('admin.careers.index')->with('success', 'Job opening created successfully.');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_open' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_open'] = $request->has('is_open');

        $career->update($data);

        return redirect()->route('admin.careers.index')->with('success', 'Job opening updated successfully.');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Job opening deleted successfully.');
    }
}
