<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('is_active', true)->latest()->paginate(9);
        return view('portfolio.index', compact('portfolios'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('portfolio.show', compact('portfolio'));
    }
}
