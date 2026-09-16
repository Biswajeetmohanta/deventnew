<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortalProjectController extends Controller
{
    public function show($id)
    {
        $project = Auth::user()->projects()
            ->with(['milestones' => function($q) {
                $q->orderBy('due_date', 'asc');
            }, 'invoices' => function($q) {
                $q->orderBy('due_date', 'desc');
            }, 'files' => function($q) {
                $q->orderBy('created_at', 'desc');
            }])
            ->findOrFail($id);

        return view('portal.project-show', compact('project'));
    }

    public function uploadFile(Request $request, $id)
    {
        $project = Auth::user()->projects()->findOrFail($id);

        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
        ]);

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            
            // Store the file in storage/app/public/project_files
            $path = $uploadedFile->store('project_files/' . $project->id, 'public');
            
            $fileSize = $this->formatBytes($uploadedFile->getSize());

            ProjectFile::create([
                'project_id' => $project->id,
                'user_id' => Auth::id(),
                'file_name' => $uploadedFile->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $fileSize,
            ]);

            return back()->with('success', 'File uploaded successfully.');
        }

        return back()->withErrors(['file' => 'Failed to upload file.']);
    }

    public function downloadInvoice($projectId, $invoiceId)
    {
        $project = Auth::user()->projects()->findOrFail($projectId);
        $invoice = $project->invoices()->findOrFail($invoiceId);

        if (!$invoice->file_path || !Storage::disk('public')->exists($invoice->file_path)) {
            abort(404, 'Invoice file not found.');
        }

        return Storage::disk('public')->download($invoice->file_path, 'invoice_' . $invoice->invoice_number . '.pdf');
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
