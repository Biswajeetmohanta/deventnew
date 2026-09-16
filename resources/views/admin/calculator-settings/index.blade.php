@extends('admin.layouts.admin')

@section('title', 'Calculator Settings')

@section('content')
<div class="glass rounded-2xl p-6 mb-6">
    <h1 class="text-2xl font-black text-slate-800">Calculator Settings</h1>
    <p class="text-sm text-slate-400 font-medium">Manage pricing configurations, base costs, multipliers, and options dynamically.</p>
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

<div class="flex flex-col gap-10">
    <!-- 1. PROJECT TYPES -->
    <div class="glass rounded-2xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-black text-slate-800"><i class="fa-solid fa-laptop-code text-amber-500 mr-2"></i> Project Types</h2>
        </div>

        <!-- Add Form -->
        <form action="{{ route('admin.calculator-settings.project-type.store') }}" method="POST" class="border-2 border-dashed border-slate-200 rounded-xl p-4 bg-slate-50/50 mb-8">
            @csrf
            <span class="block text-xs font-black uppercase text-slate-400 mb-3">Add New Project Type</span>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="text-[10px]">Slug Key (Unique)</label>
                    <input type="text" name="key" required placeholder="e.g. mobile" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Display Name</label>
                    <input type="text" name="name" required placeholder="e.g. ERP System" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Min Price ($)</label>
                    <input type="number" step="0.01" name="min_price" required placeholder="0.00" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Max Price ($)</label>
                    <input type="number" step="0.01" name="max_price" required placeholder="0.00" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Icon Class (FontAwesome)</label>
                    <input type="text" name="icon" value="fa-solid fa-gears" placeholder="fa-solid fa-gears" class="text-xs py-2 px-3">
                </div>
                <div class="md:col-span-4">
                    <label class="text-[10px]">Description</label>
                    <input type="text" name="description" placeholder="Short description of this platform type" class="text-xs py-2 px-3">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all text-xs">
                        + Create Project Type
                    </button>
                </div>
            </div>
        </form>

        <div class="flex flex-col gap-6">
            @foreach($projectTypes as $type)
                <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/30">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <form action="{{ route('admin.calculator-settings.project-type.update', $type->id) }}" method="POST" class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="text-xs">Type Key (Slug)</label>
                                <input type="text" name="key" value="{{ $type->key }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Display Name</label>
                                <input type="text" name="name" value="{{ $type->name }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Min Price ($)</label>
                                <input type="number" step="0.01" name="min_price" value="{{ $type->min_price }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Max Price ($)</label>
                                <input type="number" step="0.01" name="max_price" value="{{ $type->max_price }}" required>
                            </div>
                            <div class="md:col-span-3">
                                <label class="text-xs">Description</label>
                                <input type="text" name="description" value="{{ $type->description }}">
                            </div>
                            <div class="flex items-end gap-2">
                                <button type="submit" class="flex-grow py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all text-xs">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                        
                        <form action="{{ route('admin.calculator-settings.project-type.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project type?');" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-3.5 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition-all text-xs">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 2. COMPLEXITIES -->
    <div class="glass rounded-2xl p-6">
        <h2 class="text-lg font-black text-slate-800 mb-6"><i class="fa-solid fa-wand-magic-sparkles text-amber-500 mr-2"></i> Design & Complexity</h2>

        <!-- Add Form -->
        <form action="{{ route('admin.calculator-settings.complexity.store') }}" method="POST" class="border-2 border-dashed border-slate-200 rounded-xl p-4 bg-slate-50/50 mb-8">
            @csrf
            <span class="block text-xs font-black uppercase text-slate-400 mb-3">Add New Complexity Level</span>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="text-[10px]">Slug Key (Unique)</label>
                    <input type="text" name="key" required placeholder="e.g. premium" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Display Name</label>
                    <input type="text" name="name" required placeholder="e.g. Custom Premium" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Price Multiplier (e.g. 1.35)</label>
                    <input type="number" step="0.05" name="multiplier" required placeholder="1.0" class="text-xs py-2 px-3">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all text-xs">
                        + Create Complexity
                    </button>
                </div>
                <div class="md:col-span-4">
                    <label class="text-[10px]">Description</label>
                    <input type="text" name="description" placeholder="Visual explanation..." class="text-xs py-2 px-3">
                </div>
            </div>
        </form>

        <div class="flex flex-col gap-6">
            @foreach($complexities as $comp)
                <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/30">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <form action="{{ route('admin.calculator-settings.complexity.update', $comp->id) }}" method="POST" class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="text-xs">Complexity Key (Slug)</label>
                                <input type="text" name="key" value="{{ $comp->key }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Display Name</label>
                                <input type="text" name="name" value="{{ $comp->name }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Multiplier (e.g. 1.3)</label>
                                <input type="number" step="0.05" name="multiplier" value="{{ $comp->multiplier }}" required>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all text-xs">
                                    Save Changes
                                </button>
                            </div>
                            <div class="md:col-span-4 mt-2">
                                <label class="text-xs">Description</label>
                                <input type="text" name="description" value="{{ $comp->description }}">
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator-settings.complexity.destroy', $comp->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this complexity level?');" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-3.5 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition-all text-xs">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 3. FEATURES -->
    <div class="glass rounded-2xl p-6">
        <h2 class="text-lg font-black text-slate-800 mb-6"><i class="fa-solid fa-puzzle-piece text-amber-500 mr-2"></i> Add-on Features</h2>

        <!-- Add Form -->
        <form action="{{ route('admin.calculator-settings.feature.store') }}" method="POST" class="border-2 border-dashed border-slate-200 rounded-xl p-4 bg-slate-50/50 mb-8">
            @csrf
            <span class="block text-xs font-black uppercase text-slate-400 mb-3">Add New Feature Option</span>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="text-[10px]">Slug Key (Unique)</label>
                    <input type="text" name="key" required placeholder="e.g. auth" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Display Name</label>
                    <input type="text" name="name" required placeholder="e.g. AI Search Integration" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Min Price ($)</label>
                    <input type="number" step="0.01" name="min_price" required placeholder="0.00" class="text-xs py-2 px-3">
                </div>
                <div>
                    <label class="text-[10px]">Max Price ($)</label>
                    <input type="number" step="0.01" name="max_price" required placeholder="0.00" class="text-xs py-2 px-3">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all text-xs">
                        + Create Feature
                    </button>
                </div>
                <div class="md:col-span-5">
                    <label class="text-[10px]">Description</label>
                    <input type="text" name="description" placeholder="Module scope explanation..." class="text-xs py-2 px-3">
                </div>
            </div>
        </form>

        <div class="flex flex-col gap-6">
            @foreach($features as $feat)
                <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/30">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <form action="{{ route('admin.calculator-settings.feature.update', $feat->id) }}" method="POST" class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="text-xs">Feature Key (Slug)</label>
                                <input type="text" name="key" value="{{ $feat->key }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Display Name</label>
                                <input type="text" name="name" value="{{ $feat->name }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Min Price ($)</label>
                                <input type="number" step="0.01" name="min_price" value="{{ $feat->min_price }}" required>
                            </div>
                            <div>
                                <label class="text-xs">Max Price ($)</label>
                                <input type="number" step="0.01" name="max_price" value="{{ $feat->max_price }}" required>
                            </div>
                            <div class="md:col-span-3">
                                <label class="text-xs">Description</label>
                                <input type="text" name="description" value="{{ $feat->description }}">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all text-xs">
                                    Save Changes
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('admin.calculator-settings.feature.destroy', $feat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feature?');" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-3.5 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition-all text-xs">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 4. SCREENS & TIMELINES -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Screens multiplier -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-4"><i class="fa-solid fa-mobile-button text-amber-500 mr-2"></i> Screen / Page Scale</h2>

            <!-- Add Form -->
            <form action="{{ route('admin.calculator-settings.screen.store') }}" method="POST" class="border-2 border-dashed border-slate-200 rounded-xl p-3 bg-slate-50/50 mb-6">
                @csrf
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="text-[10px]">Slug Key (Unique)</label>
                        <input type="text" name="key" required placeholder="e.g. small" class="text-xs p-2">
                    </div>
                    <div>
                        <label class="text-[10px]">Range</label>
                        <input type="text" name="name" required placeholder="50+ Screens" class="text-xs p-2">
                    </div>
                    <div>
                        <label class="text-[10px]">Multiplier</label>
                        <input type="number" step="0.05" name="multiplier" required placeholder="1.0" class="text-xs p-2">
                    </div>
                    <div class="col-span-3">
                        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-[10px]">
                            + Create Screen Scale
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex flex-col gap-4">
                @foreach($screens as $scr)
                    <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/30">
                        <div class="flex gap-2 items-end">
                            <form action="{{ route('admin.calculator-settings.screen.update', $scr->id) }}" method="POST" class="flex-grow grid grid-cols-3 gap-2">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="text-[10px]">Slug Key</label>
                                    <input type="text" name="key" value="{{ $scr->key }}" required class="text-xs p-2">
                                </div>
                                <div>
                                    <label class="text-[10px]">Range</label>
                                    <input type="text" name="name" value="{{ $scr->name }}" required class="text-xs p-2">
                                </div>
                                <div>
                                    <label class="text-[10px]">Multiplier</label>
                                    <input type="number" step="0.05" name="multiplier" value="{{ $scr->multiplier }}" required class="text-xs p-2">
                                </div>
                                <div class="col-span-3 mt-1">
                                    <button type="submit" class="w-full py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl text-[10px]">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                            
                            <form action="{{ route('admin.calculator-settings.screen.destroy', $scr->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this screen range?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl text-[10px]">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Timelines multiplier -->
        <div class="glass rounded-2xl p-6">
            <h2 class="text-lg font-black text-slate-800 mb-4"><i class="fa-solid fa-clock text-amber-500 mr-2"></i> Target Timelines</h2>

            <!-- Add Form -->
            <form action="{{ route('admin.calculator-settings.timeline.store') }}" method="POST" class="border-2 border-dashed border-slate-200 rounded-xl p-3 bg-slate-50/50 mb-6">
                @csrf
                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <label class="text-[10px]">Slug Key (Unique)</label>
                        <input type="text" name="key" required placeholder="e.g. flexible" class="text-xs p-2 mb-1">
                    </div>
                    <div class="col-span-2">
                        <label class="text-[10px]">Title</label>
                        <input type="text" name="name" required placeholder="Normal Timeline" class="text-xs p-2 mb-1">
                        <label class="text-[10px]">Duration Text</label>
                        <input type="text" name="duration" required placeholder="1 to 3 months" class="text-xs p-2">
                    </div>
                    <div>
                        <label class="text-[10px]">Multiplier</label>
                        <input type="number" step="0.05" name="multiplier" required placeholder="1.15" class="text-xs p-2">
                    </div>
                    <div class="col-span-4 mt-2">
                        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-[10px]">
                            + Create Timeline
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex flex-col gap-4">
                @foreach($timelines as $time)
                    <div class="border border-slate-100 rounded-xl p-3 bg-slate-50/30">
                        <div class="flex gap-2 items-end">
                            <form action="{{ route('admin.calculator-settings.timeline.update', $time->id) }}" method="POST" class="flex-grow grid grid-cols-4 gap-2">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="text-[10px]">Slug Key</label>
                                    <input type="text" name="key" value="{{ $time->key }}" required class="text-xs p-2 mb-1">
                                </div>
                                <div class="col-span-2">
                                    <label class="text-[10px]">Title & Duration</label>
                                    <input type="text" name="name" value="{{ $time->name }}" required class="text-xs p-2 mb-1">
                                    <input type="text" name="duration" value="{{ $time->duration }}" required class="text-xs p-2">
                                </div>
                                <div>
                                    <label class="text-[10px]">Multiplier</label>
                                    <input type="number" step="0.05" name="multiplier" value="{{ $time->multiplier }}" required class="text-xs p-2">
                                </div>
                                <div class="col-span-4 mt-1">
                                    <button type="submit" class="w-full py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl text-[10px]">
                                        Save Changes
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('admin.calculator-settings.timeline.destroy', $time->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this timeline?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl text-[10px]">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
