<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('status', true)->orderBy('sort_order')->orderBy('name')->get();
        return view('clients', compact('clients'));
    }
}
