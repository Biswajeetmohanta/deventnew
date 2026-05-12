@extends('admin.layouts.admin')

@section('title', 'Inquiry Details')
@section('page_title', 'Message from ' . $inquiry->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.inquiries.index') }}" class="text-slate-500 hover:text-slate-800 transition-all flex items-center font-medium">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <div class="glass p-8 rounded-3xl space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h4 class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Sender Name</h4>
                <p class="text-lg font-bold text-slate-800">{{ $inquiry->name }}</p>
            </div>
            <div>
                <h4 class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Email Address</h4>
                <p class="text-lg font-bold text-amber-600">{{ $inquiry->email }}</p>
            </div>
            <div>
                <h4 class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Phone Number</h4>
                <p class="text-lg font-bold text-slate-800">{{ $inquiry->phone ?? 'N/A' }}</p>
            </div>
            <div>
                <h4 class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Received On</h4>
                <p class="text-lg font-bold text-slate-800">{{ $inquiry->created_at->format('F d, Y @ h:i A') }}</p>
            </div>
        </div>

        <hr class="border-slate-100">

        <div>
            <h4 class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Subject</h4>
            <p class="text-lg font-bold text-slate-800 bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $inquiry->subject ?? 'No Subject Provided' }}</p>
        </div>

        <div>
            <h4 class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-3">Message Content</h4>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 whitespace-pre-wrap leading-relaxed text-slate-700 shadow-sm min-h-[150px]">
                {{ $inquiry->message }}
            </div>
        </div>

        <div class="pt-6 flex justify-between items-center border-t border-slate-100">
            <a href="mailto:{{ $inquiry->email }}" class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-8 py-3 rounded-xl transition-all shadow-lg flex items-center">
                <i class="fa-solid fa-reply mr-2"></i> Reply via Email
            </a>
            
            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-100 font-bold px-6 py-3 rounded-xl transition-all" onclick="return confirm('Are you sure you want to delete this inquiry?')">
                    <i class="fa-solid fa-trash-can mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
