@extends('admin.layouts.admin')

@section('title', 'Edit Client')

@section('content')
<div class="glass rounded-2xl p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Edit Portal Client</h1>
            <p class="text-sm text-slate-400 font-medium">Update client details or reset their workspace password.</p>
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

    <form action="{{ route('admin.portal-clients.update', $client->id) }}" method="POST" class="flex flex-col gap-5">
        @csrf
        @method('PUT')
        
        <div>
            <label>Name / Company Name</label>
            <input type="text" name="name" value="{{ old('name', $client->name) }}" required>
        </div>

        <div>
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email', $client->email) }}" required>
        </div>

        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl mt-2">
            <h3 class="text-xs font-black uppercase text-slate-500 mb-2">Change Password</h3>
            <p class="text-xs text-slate-400 font-medium mb-4">Leave the fields blank below if you don't want to change the password.</p>

            <div class="flex flex-col gap-4">
                <div>
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="New Password">
                </div>

                <div>
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-sm">
            Save Client Account
        </button>
    </form>
</div>
@endsection
