<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Technology;

class PortfolioController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $technologies = Technology::all();
        return view('admin.portfolios.create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'portfolios');
        }

        $portfolio = Portfolio::create($data);
        
        if ($request->has('technologies')) {
            $portfolio->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Project created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $technologies = Technology::all();
        return view('admin.portfolios.edit', compact('portfolio', 'technologies'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                $this->deleteImageDirect($portfolio->image);
            }
            $data['image'] = $this->uploadImageDirect($request->file('image'), 'portfolios');
        }

        $portfolio->update($data);

        if ($request->has('technologies')) {
            $portfolio->technologies()->sync($request->technologies);
        } else {
            $portfolio->technologies()->sync([]);
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            $this->deleteImageDirect($portfolio->image);
        }
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Project deleted successfully.');
    }
}
