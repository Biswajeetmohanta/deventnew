<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class PriceCalculatorController extends Controller
{
    public function index()
    {
        $projectTypes = \App\Models\CalculatorProjectType::all();
        $complexities = \App\Models\CalculatorComplexity::all();
        $features = \App\Models\CalculatorFeature::all();
        $screens = \App\Models\CalculatorScreen::all();
        $timelines = \App\Models\CalculatorTimeline::all();

        return view('price-calculator', compact(
            'projectTypes',
            'complexities',
            'features',
            'screens',
            'timelines'
        ));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'project_type' => 'required|string',
            'features' => 'nullable|array',
            'complexity' => 'required|string',
            'screens' => 'required|string',
            'urgency' => 'required|string',
            'estimate_min' => 'required|numeric',
            'estimate_max' => 'required|numeric',
        ]);

        $featuresList = !empty($validated['features']) ? implode(', ', $validated['features']) : 'None';
        
        $message = "Price Calculator Submission:\n" .
                   "-----------------------------------\n" .
                   "Project Type: " . ucfirst($validated['project_type']) . "\n" .
                   "Complexity: " . ucfirst($validated['complexity']) . "\n" .
                   "Screens: " . $validated['screens'] . "\n" .
                   "Urgency: " . ucfirst($validated['urgency']) . "\n" .
                   "Selected Features: " . $featuresList . "\n" .
                   "-----------------------------------\n" .
                   "Calculated Estimate: $" . number_format($validated['estimate_min']) . " - $" . number_format($validated['estimate_max']) . "\n";

        Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => 'Price Estimate Request - ' . ucfirst($validated['project_type']),
            'message' => $message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your estimate request has been submitted. We will contact you soon.'
        ]);
    }
}
