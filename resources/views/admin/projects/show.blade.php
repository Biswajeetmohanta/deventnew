@extends('admin.layouts.admin')

@section('title', 'Manage Project: ' . $project->name)

@section('content')
<div class="glass rounded-2xl p-6 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors inline-flex items-center gap-1 mb-2">
            <i class="fa-solid fa-arrow-left"></i> Back to Projects
        </a>
        <h1 class="text-2xl font-black text-slate-800">{{ $project->name }}</h1>
        <p class="text-sm text-slate-400 font-medium mt-1">Client: <strong>{{ $project->user->name }}</strong> ({{ $project->user->email }})</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.projects.edit', $project->id) }}" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold rounded-xl transition-colors text-sm">
            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit Project Details
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl mb-6 font-bold text-sm">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 font-bold text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
    <!-- LEFT: Milestones -->
    <div class="lg:col-span-2 flex flex-col gap-6">
        <!-- Milestone Add Panel -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-4">Add Project Milestone</h2>
            <form action="{{ route('admin.projects.milestones.add', $project->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @csrf
                <div class="sm:col-span-2">
                    <label class="text-xs">Milestone Title</label>
                    <input type="text" name="title" required placeholder="e.g. Database Design & API Setup">
                </div>
                <div class="sm:col-span-2">
                    <label class="text-xs">Description</label>
                    <textarea name="description" rows="2" placeholder="Detail milestone deliverables..."></textarea>
                </div>
                <div>
                    <label class="text-xs">Due Date</label>
                    <input type="date" name="due_date">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-colors shadow-sm text-sm">
                        Add Milestone
                    </button>
                </div>
            </form>
        </div>

        <!-- Milestones list -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-6">Current Milestones ({{ $project->milestones->count() }})</h2>
            
            <div class="flex flex-col gap-4">
                @forelse($project->milestones as $milestone)
                    <div class="border border-slate-100 rounded-xl p-4 flex items-center justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <form action="{{ route('admin.projects.milestones.toggle', [$project->id, $milestone->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-6 h-6 rounded-full border-2 flex items-center justify-center mt-0.5 transition-colors
                                    @if($milestone->status === 'completed') bg-green-500 border-green-500 text-white
                                    @else border-slate-300 hover:border-green-500 text-transparent @endif">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </button>
                            </form>

                            <div>
                                <span class="block font-bold text-slate-800 text-sm leading-tight {{ $milestone->status === 'completed' ? 'line-through text-slate-400' : '' }}">
                                    {{ $milestone->title }}
                                </span>
                                @if($milestone->due_date)
                                    <span class="block text-[10px] text-slate-400 font-bold uppercase mt-1">Due: {{ $milestone->due_date->format('M d, Y') }}</span>
                                @endif
                                @if($milestone->description)
                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $milestone->description }}</p>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('admin.projects.milestones.delete', [$project->id, $milestone->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this milestone?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1.5">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-center py-6 text-sm text-slate-400 font-medium">No milestones defined yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- RIGHT: Invoices & Uploaded Files -->
    <div class="flex flex-col gap-6">
        <!-- Add Invoice Panel -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-4">Upload Invoice (PDF)</h2>
            <form action="{{ route('admin.projects.invoices.add', $project->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label class="text-xs">Invoice Number</label>
                    <input type="text" name="invoice_number" required placeholder="e.g. INV-2026-001">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs">Amount ($)</label>
                        <input type="number" step="0.01" name="amount" required placeholder="0.00">
                    </div>
                    <div>
                        <label class="text-xs">Status</label>
                        <select name="status" required>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs">Due Date</label>
                    <input type="date" name="due_date" required>
                </div>
                <div>
                    <label class="text-xs">Select PDF File</label>
                    <input type="file" name="file" accept="application/pdf" required class="text-sm">
                </div>
                <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-colors shadow-sm text-sm">
                    Upload & Add Invoice
                </button>
            </form>
        </div>

        <!-- Invoices List -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-4">Uploaded Invoices</h2>
            <div class="flex flex-col gap-3">
                @forelse($project->invoices as $invoice)
                    <div class="border border-slate-100 rounded-xl p-3 flex items-center justify-between gap-3 text-xs">
                        <div>
                            <span class="block font-bold text-slate-800">{{ $invoice->invoice_number }}</span>
                            <span class="block text-slate-400 mt-0.5">Due: {{ $invoice->due_date->format('M d, Y') }}</span>
                            <span class="block font-black text-slate-800 mt-1">${{ number_format($invoice->amount, 2) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded-full font-black uppercase text-[9px]
                                @if($invoice->status === 'paid') bg-green-50 text-green-600
                                @elseif($invoice->status === 'unpaid') bg-red-50 text-red-600
                                @else bg-yellow-50 text-yellow-600 @endif">
                                {{ $invoice->status }}
                            </span>
                            <form action="{{ route('admin.projects.invoices.delete', [$project->id, $invoice->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center py-4 text-xs text-slate-400 font-medium">No invoices uploaded.</p>
                @endforelse
            </div>
        </div>

        <!-- Shared Documents List -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-4">Client Uploaded Documents</h2>
            <div class="flex flex-col gap-3">
                @forelse($project->files as $file)
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex items-center justify-between gap-3">
                        <div class="overflow-hidden">
                            <span class="block text-xs font-bold text-slate-800 truncate leading-tight">{{ $file->file_name }}</span>
                            <span class="block text-[10px] text-slate-400 mt-0.5">Uploaded by: {{ $file->user->name }} • {{ $file->file_size }}</span>
                        </div>
                        <a href="{{ Storage::url($file->file_path) }}" target="_blank" download class="text-slate-400 hover:text-[#0052FF] transition-colors p-1.5">
                            <i class="fa-solid fa-download text-sm"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-center py-4 text-xs text-slate-400 font-medium">No documents shared yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
