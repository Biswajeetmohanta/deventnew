<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::where('status', true)->orderBy('sort_order')->orderBy('title')->get();
        return view('certificates', compact('certificates'));
    }
}
