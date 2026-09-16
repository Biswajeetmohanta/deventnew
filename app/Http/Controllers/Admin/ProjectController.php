<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectInvoice;
use App\Models\ProjectMilestone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'progress_percent' => 'required|integer|min:0|max:100',
            'status' => 'required|string|in:planning,in_progress,review,completed',
        ]);

        Project::create($request->all());

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::with(['user', 'milestones', 'invoices', 'files.user'])->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'progress_percent' => 'required|integer|min:0|max:100',
            'status' => 'required|string|in:planning,in_progress,review,completed',
        ]);

        $project->update($request->all());

        return redirect()->route('admin.projects.show', $project->id)->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    // Milestones Management
    public function addMilestone(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        ProjectMilestone::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Milestone added successfully.');
    }

    public function toggleMilestone($projectId, $milestoneId)
    {
        $milestone = ProjectMilestone::where('project_id', $projectId)->findOrFail($milestoneId);
        $milestone->status = $milestone->status === 'completed' ? 'pending' : 'completed';
        $milestone->save();

        return back()->with('success', 'Milestone status updated.');
    }

    public function deleteMilestone($projectId, $milestoneId)
    {
        $milestone = ProjectMilestone::where('project_id', $projectId)->findOrFail($milestoneId);
        $milestone->delete();

        return back()->with('success', 'Milestone deleted successfully.');
    }

    // Invoices Management
    public function addInvoice(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $request->validate([
            'invoice_number' => 'required|string|unique:project_invoices,invoice_number',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|string|in:unpaid,paid,overdue',
            'file' => 'required|file|mimes:pdf|max:10240', // Max 10MB PDF
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('invoices/' . $project->id, 'public');

            ProjectInvoice::create([
                'project_id' => $project->id,
                'invoice_number' => $request->invoice_number,
                'amount' => $request->amount,
                'due_date' => $request->due_date,
                'status' => $request->status,
                'file_path' => $path,
            ]);

            return back()->with('success', 'Invoice uploaded and added.');
        }

        return back()->withErrors(['file' => 'Failed to upload invoice file.']);
    }

    public function deleteInvoice($projectId, $invoiceId)
    {
        $invoice = ProjectInvoice::where('project_id', $projectId)->findOrFail($invoiceId);
        
        if ($invoice->file_path) {
            Storage::disk('public')->delete($invoice->file_path);
        }
        
        $invoice->delete();

        return back()->with('success', 'Invoice deleted successfully.');
    }
}
