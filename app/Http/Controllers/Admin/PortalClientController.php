<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PortalClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->orderBy('created_at', 'desc')->get();
        return view('admin.portal-clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.portal-clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        return redirect()->route('admin.portal-clients.index')->with('success', 'Client account created successfully.');
    }

    public function edit($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        return view('admin.portal-clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = User::where('role', 'client')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $client->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $client->name = $request->name;
        $client->email = $request->email;

        if ($request->filled('password')) {
            $client->password = Hash::make($request->password);
        }

        $client->save();

        return redirect()->route('admin.portal-clients.index')->with('success', 'Client account updated successfully.');
    }

    public function destroy($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->delete();

        return redirect()->route('admin.portal-clients.index')->with('success', 'Client account deleted successfully.');
    }
}
