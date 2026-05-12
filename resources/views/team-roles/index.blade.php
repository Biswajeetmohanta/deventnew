@extends('layouts.app')

@section('title', 'Build Your Team | Devent Technology')

@section('content')
<section style="padding: 160px 0 100px 0; background: #fff; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; opacity: 0.4;">
        <div style="position: absolute; top: 0; right: 0; width: 40%; height: 40%; background: radial-gradient(circle, #eff6ff 0%, transparent 70%);"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div style="max-width: 800px;">
            <span style="color: #3b82f6; font-weight: 900; font-size: 14px; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 24px; display: block;">Talent on Demand</span>
            <h1 style="font-size: 64px; font-weight: 900; color: #0f172a; line-height: 1.1; margin-bottom: 32px; letter-spacing: -0.02em;">Build Your <span style="color: #3b82f6;">Expert Team</span> in Days, Not Months</h1>
            <p style="color: #64748b; font-size: 20px; line-height: 1.7;">Access top-tier developers and engineers vetted for technical excellence and cultural fit. Scale your product development with ease.</p>
        </div>
    </div>
</section>

<section style="padding: 80px 0 140px 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($roles as $role)
            <a href="{{ url('/build-your-team/' . $role->slug) }}" class="premium-card group block">
                <div class="premium-card-icon">
                    <i class="{{ $role->icon ?? 'fa-solid fa-user-plus' }}" style="font-size: 28px;"></i>
                </div>
                <h3 class="premium-card-title !text-2xl">{{ $role->title }}</h3>
                <p class="premium-card-text mb-8">{{ Str::limit($role->content_data['about']['description'] ?? '', 140) }}</p>
                <div style="display: flex; align-items: center; gap: 10px; color: #3b82f6; font-weight: 900; font-size: 15px;">
                    Hire Specialist
                    <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-2"></i>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
