@extends('admin.layouts.admin')

@section('title', 'Add Client')

@section('content')
<div class="glass rounded-2xl p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Add Portal Client</h1>
            <p class="text-sm text-slate-400 font-medium">Create a login account for a client to access their workspace portal.</p>
        </div>
        <a href="{{ route('admin.portal-clients.index') }}" class="px-4 py-2 border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold rounded-xl transition-colors">
            Back
        </a>
    </div>
</div>

<div class="glass rounded-2xl p-6 max-w-xl">
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-xs font-bold">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.portal-clients.store') }}" method="POST" class="flex flex-col gap-5">
        @csrf
        <div>
            <label>Name / Company Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Acme Corp">
        </div>

        <div>
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. contact@acme.com">
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required placeholder="Minimum 8 characters">
        </div>

        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required placeholder="Confirm Password">
        </div>

        <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-sm">
            Create Client Account
        </button>
    </form>
</div>
@endsection
