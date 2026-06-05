<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    use HandlesDirectImageUploads;

    public function index()
    {
        $certificates = Certificate::orderBy('sort_order')->orderBy('title')->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_or_pdf' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:5120',
            'issuer' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_or_pdf')) {
            $data['image_or_pdf'] = $this->uploadImageDirect($request->file('image_or_pdf'), 'certificates');
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate added successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_or_pdf' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:5120',
            'issuer' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_or_pdf')) {
            if ($certificate->image_or_pdf) {
                $this->deleteImageDirect($certificate->image_or_pdf);
            }
            $data['image_or_pdf'] = $this->uploadImageDirect($request->file('image_or_pdf'), 'certificates');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image_or_pdf) {
            $this->deleteImageDirect($certificate->image_or_pdf);
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
