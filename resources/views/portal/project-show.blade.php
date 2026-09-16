@extends('portal.layouts.app')

@section('title', $project->name . ' - Details | Client Portal')

@section('content')
<div class="mb-8">
    <a href="{{ url('/portal') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors inline-flex items-center gap-1 mb-4">
        <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
    </a>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $project->name }}</h1>
            <p class="text-slate-500 font-medium mt-1">{{ $project->description ?? 'No project details provided yet.' }}</p>
        </div>
        <div>
            <span class="text-xs font-black uppercase tracking-wider px-4 py-2 rounded-full border border-slate-200 bg-white shadow-sm inline-block">
                Status: 
                <span class="@if($project->status === 'completed') text-green-600
                             @elseif($project->status === 'in_progress') text-blue-600
                             @elseif($project->status === 'review') text-yellow-600
                             @else text-slate-500 @endif font-black">
                    {{ str_replace('_', ' ', $project->status) }}
                </span>
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- LEFT: Project progress & milestones -->
    <div class="lg:col-span-2 flex flex-col gap-8">
        <!-- Progress panel -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <h3 class="text-lg font-black text-slate-800 mb-4">Project Progress</h3>
            <div class="flex justify-between items-center text-xs font-bold text-slate-400 mb-2">
                <span>Completed Tasks</span>
                <span>{{ $project->progress_percent }}%</span>
            </div>
            <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                <div class="bg-[#0052FF] h-full transition-all duration-300" style="width: {{ $project->progress_percent }}%;"></div>
            </div>
        </div>

        <!-- Milestones list -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <h3 class="text-lg font-black text-slate-800 mb-6">Milestones & Phases</h3>
            
            @if($project->milestones->isEmpty())
                <div class="text-center py-8">
                    <p class="text-sm text-slate-400 font-medium">No milestones defined for this project yet.</p>
                </div>
            @else
                <div class="flex flex-col gap-6 relative before:absolute before:left-3 before:top-2 before:bottom-2 before:w-[2px] before:bg-slate-100">
                    @foreach($project->milestones as $milestone)
                        <div class="flex gap-4 relative z-10">
                            <!-- Status Indicator Circle -->
                            <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center border-2 
                                @if($milestone->status === 'completed') bg-green-500 border-green-500 text-white
                                @else bg-white border-slate-300 text-slate-300 @endif mt-1">
                                @if($milestone->status === 'completed')
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                @endif
                            </div>
                            <!-- Details -->
                            <div>
                                <span class="block font-black text-slate-800 text-base leading-tight">{{ $milestone->title }}</span>
                                @if($milestone->due_date)
                                    <span class="inline-block text-[10px] text-slate-400 font-bold uppercase mt-1">
                                        Due: {{ $milestone->due_date->format('M d, Y') }}
                                    </span>
                                @endif
                                @if($milestone->description)
                                    <p class="text-sm text-slate-500 font-medium mt-2 leading-relaxed">
                                        {{ $milestone->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- RIGHT: Invoices & Shared Files -->
    <div class="flex flex-col gap-8">
        <!-- Invoices List -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <h3 class="text-lg font-black text-slate-800 mb-6">Invoices</h3>

            @if($project->invoices->isEmpty())
                <div class="text-center py-8">
                    <p class="text-sm text-slate-400 font-medium">No invoices uploaded yet.</p>
                </div>
            @else
                <div class="flex flex-col gap-4">
                    @foreach($project->invoices as $invoice)
                        <div class="border border-slate-100 rounded-2xl p-4 flex items-center justify-between gap-4">
                            <div>
                                <span class="block font-black text-slate-800 text-sm leading-tight">{{ $invoice->invoice_number }}</span>
                                <span class="block text-[10px] text-slate-400 font-bold mt-1 uppercase">
                                    Due: {{ $invoice->due_date->format('M d, Y') }}
                                </span>
                                <span class="inline-block text-xs font-black text-slate-800 mt-2">${{ number_format($invoice->amount, 2) }}</span>
                            </div>
                            
                            <div class="flex flex-col items-end gap-2">
                                <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded-full 
                                    @if($invoice->status === 'paid') bg-green-50 text-green-600
                                    @elseif($invoice->status === 'unpaid') bg-red-50 text-red-600
                                    @else bg-yellow-50 text-yellow-600 @endif">
                                    {{ $invoice->status }}
                                </span>

                                @if($invoice->file_path)
                                    <a href="{{ url('/portal/projects/' . $project->id . '/invoices/' . $invoice->id . '/download') }}" class="text-xs font-bold text-[#0052FF] hover:underline flex items-center gap-1">
                                        <i class="fa-solid fa-file-arrow-down"></i> Download
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Shared Files Section -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
            <h3 class="text-lg font-black text-slate-800 mb-4">Shared Documents</h3>

            <!-- File Upload form -->
            <form action="{{ url('/portal/projects/' . $project->id . '/files') }}" method="POST" enctype="multipart/form-data" class="mb-6">
                @csrf
                <div class="border-2 border-dashed border-slate-200 hover:border-blue-400 rounded-2xl p-4 text-center cursor-pointer relative transition-all group">
                    <input type="file" name="file" required onchange="this.form.submit()" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-cloud-arrow-up text-slate-400 group-hover:text-blue-500 text-2xl mb-2 transition-colors"></i>
                        <span class="text-xs font-bold text-slate-600 block">Click to upload a document</span>
                        <span class="text-[10px] text-slate-400 font-medium block mt-1">PDF, DOC, ZIP, or Image (Max 10MB)</span>
                    </div>
                </div>
            </form>

            @if($project->files->isEmpty())
                <div class="text-center py-6">
                    <p class="text-sm text-slate-400 font-medium">No shared documents yet.</p>
                </div>
            @else
                <div class="flex flex-col gap-3">
                    @foreach($project->files as $file)
                        <div class="bg-slate-50 rounded-2xl p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#0052FF] flex items-center justify-center text-sm flex-shrink-0">
                                @if(Str::endsWith($file->file_name, ['.pdf']))
                                    <i class="fa-solid fa-file-pdf"></i>
                                @elseif(Str::endsWith($file->file_name, ['.zip', '.rar']))
                                    <i class="fa-solid fa-file-zipper"></i>
                                @elseif(Str::endsWith($file->file_name, ['.png', '.jpg', '.jpeg', '.gif']))
                                    <i class="fa-solid fa-file-image"></i>
                                @else
                                    <i class="fa-solid fa-file-lines"></i>
                                @endif
                            </div>
                            <div class="overflow-hidden flex-grow">
                                <span class="block text-xs font-black text-slate-800 truncate leading-tight">{{ $file->file_name }}</span>
                                <span class="block text-[10px] text-slate-400 font-semibold mt-1">
                                    {{ $file->file_size }} • {{ $file->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            <a href="{{ Storage::url($file->file_path) }}" target="_blank" download class="text-slate-400 hover:text-[#0052FF] transition-colors flex-shrink-0 text-sm p-1">
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
