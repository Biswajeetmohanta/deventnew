<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use App\Models\Industry;
use App\Models\Technology;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    /**
     * Display a listing of case studies.
     */
    public function index(Request $request)
    {
        $query = CaseStudy::where('is_active', true)->with(['industry', 'technologies']);

        if ($request->filled('industry')) {
            $query->whereHas('industry', function ($q) use ($request) {
                $q->where('slug', $request->industry);
            });
        }

        if ($request->filled('technology')) {
            $query->whereHas('technologies', function ($q) use ($request) {
                $q->where('slug', $request->technology);
            });
        }

        $caseStudies = $query->orderBy('order')->latest()->paginate(9);
        $industries = Industry::all();
        $technologies = Technology::where('is_active', true)->get();

        return view('case-studies.index', compact('caseStudies', 'industries', 'technologies'));
    }

    /**
     * Display the specified case study.
     */
    public function show($slug)
    {
        $caseStudy = CaseStudy::where('slug', $slug)
            ->where('is_active', true)
            ->with(['industry', 'technologies'])
            ->firstOrFail();

        $otherCaseStudies = CaseStudy::where('id', '!=', $caseStudy->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('case-studies.show', compact('caseStudy', 'otherCaseStudies'));
    }
}
