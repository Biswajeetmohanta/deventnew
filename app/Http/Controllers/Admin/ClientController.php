<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use HandlesDirectImageUploads;

    public function index()
    {
        $clients = Client::orderBy('sort_order')->orderBy('name')->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadImageDirect($request->file('logo'), 'clients');
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Portfolio project added successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($client->logo) {
                $this->deleteImageDirect($client->logo);
            }
            $data['logo'] = $this->uploadImageDirect($request->file('logo'), 'clients');
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Portfolio project updated successfully.');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) {
            $this->deleteImageDirect($client->logo);
        }
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Portfolio project deleted successfully.');
    }
}
