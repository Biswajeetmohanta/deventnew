<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = \App\Models\JobApplication::with('career')->latest()->paginate(20);
        return view('admin.applications.index', compact('applications'));
    }

    public function show(string $id)
    {
        $application = \App\Models\JobApplication::with('career')->findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    public function update(Request $request, string $id)
    {
        $application = \App\Models\JobApplication::findOrFail($id);
        $request->validate(['status' => 'required|string']);
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Application status updated successfully.');
    }

    public function destroy(string $id)
    {
        $application = \App\Models\JobApplication::findOrFail($id);
        $application->delete();
        return back()->with('success', 'Application deleted successfully.');
    }
}
