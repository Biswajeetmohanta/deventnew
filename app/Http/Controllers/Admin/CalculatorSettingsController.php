<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalculatorComplexity;
use App\Models\CalculatorFeature;
use App\Models\CalculatorProjectType;
use App\Models\CalculatorScreen;
use App\Models\CalculatorTimeline;
use Illuminate\Http\Request;

class CalculatorSettingsController extends Controller
{
    public function index()
    {
        $projectTypes = CalculatorProjectType::all();
        $complexities = CalculatorComplexity::all();
        $features = CalculatorFeature::all();
        $screens = CalculatorScreen::all();
        $timelines = CalculatorTimeline::all();

        return view('admin.calculator-settings.index', compact(
            'projectTypes',
            'complexities',
            'features',
            'screens',
            'timelines'
        ));
    }

    public function storeProjectType(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_project_types,key',
            'name' => 'required|string|max:255',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);
        
        CalculatorProjectType::create($request->all());
        return back()->with('success', 'Project type created successfully.');
    }

    public function updateProjectType(Request $request, $id)
    {
        $type = CalculatorProjectType::findOrFail($id);
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_project_types,key,' . $type->id,
            'name' => 'required|string|max:255',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);
        $type->update($request->all());
        return back()->with('success', 'Project type updated successfully.');
    }

    public function destroyProjectType($id)
    {
        CalculatorProjectType::findOrFail($id)->delete();
        return back()->with('success', 'Project type deleted successfully.');
    }

    public function storeComplexity(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_complexities,key',
            'name' => 'required|string|max:255',
            'multiplier' => 'required|numeric|min:0.1',
            'description' => 'nullable|string',
        ]);
        
        CalculatorComplexity::create($request->all());
        return back()->with('success', 'Complexity created successfully.');
    }

    public function updateComplexity(Request $request, $id)
    {
        $comp = CalculatorComplexity::findOrFail($id);
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_complexities,key,' . $comp->id,
            'name' => 'required|string|max:255',
            'multiplier' => 'required|numeric|min:0.1',
            'description' => 'nullable|string',
        ]);
        $comp->update($request->all());
        return back()->with('success', 'Complexity updated successfully.');
    }

    public function destroyComplexity($id)
    {
        CalculatorComplexity::findOrFail($id)->delete();
        return back()->with('success', 'Complexity deleted successfully.');
    }

    public function storeFeature(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_features,key',
            'name' => 'required|string|max:255',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        
        CalculatorFeature::create($request->all());
        return back()->with('success', 'Feature created successfully.');
    }

    public function updateFeature(Request $request, $id)
    {
        $feat = CalculatorFeature::findOrFail($id);
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_features,key,' . $feat->id,
            'name' => 'required|string|max:255',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        $feat->update($request->all());
        return back()->with('success', 'Feature updated successfully.');
    }

    public function destroyFeature($id)
    {
        CalculatorFeature::findOrFail($id)->delete();
        return back()->with('success', 'Feature deleted successfully.');
    }

    public function storeScreen(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_screens,key',
            'name' => 'required|string|max:255',
            'multiplier' => 'required|numeric|min:0.1',
        ]);
        
        CalculatorScreen::create($request->all());
        return back()->with('success', 'Screen size created successfully.');
    }

    public function updateScreen(Request $request, $id)
    {
        $scr = CalculatorScreen::findOrFail($id);
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_screens,key,' . $scr->id,
            'name' => 'required|string|max:255',
            'multiplier' => 'required|numeric|min:0.1',
        ]);
        $scr->update($request->all());
        return back()->with('success', 'Screen size updated successfully.');
    }

    public function destroyScreen($id)
    {
        CalculatorScreen::findOrFail($id)->delete();
        return back()->with('success', 'Screen size deleted successfully.');
    }

    public function storeTimeline(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_timelines,key',
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'multiplier' => 'required|numeric|min:0.1',
        ]);
        
        CalculatorTimeline::create($request->all());
        return back()->with('success', 'Timeline created successfully.');
    }

    public function updateTimeline(Request $request, $id)
    {
        $time = CalculatorTimeline::findOrFail($id);
        $request->validate([
            'key' => 'required|string|max:255|unique:calculator_timelines,key,' . $time->id,
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'multiplier' => 'required|numeric|min:0.1',
        ]);
        $time->update($request->all());
        return back()->with('success', 'Timeline updated successfully.');
    }

    public function destroyTimeline($id)
    {
        CalculatorTimeline::findOrFail($id)->delete();
        return back()->with('success', 'Timeline deleted successfully.');
    }
}
