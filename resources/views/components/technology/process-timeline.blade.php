@props(['title', 'subtitle' => '', 'steps' => [], 'image' => ''])

@if(count($steps) > 0)
<section style="padding: 80px 0; background: #fff;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            {{-- Left Column: Title & Steps --}}
            <div>
                <div style="width: 40px; height: 3px; background: #3b82f6; border-radius: 2px; margin-bottom: 20px;"></div>
                <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 16px;">{{ $title }}</h2>
                @if($subtitle)
                    <p style="color: #64748b; font-size: 15px; line-height: 1.7; margin-bottom: 30px;">{{ $subtitle }}</p>
                @endif

                <div style="display: flex; flex-direction: column; gap: 0;">
                    @php
                        $stepIcons = ['fa-solid fa-clipboard-list','fa-solid fa-pencil-ruler','fa-solid fa-code','fa-solid fa-rocket','fa-solid fa-check-double','fa-solid fa-headset'];
                    @endphp
                    @foreach($steps as $index => $step)
                        <div style="display: flex; align-items: flex-start; gap: 20px; padding: 24px 0; {{ $index < count($steps) - 1 ? 'border-bottom: 1px solid #e2e8f0;' : '' }}">
                            <div style="width: 36px; height: 36px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: #fff; font-size: 13px; font-weight: 800;">{{ $index + 1 }}</span>
                            </div>
                            <div style="width: 42px; height: 42px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="{{ $stepIcons[$index % count($stepIcons)] }}" style="color: #64748b; font-size: 16px;"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">{{ $step['title'] ?? '' }}</h4>
                                <p style="font-size: 13px; color: #64748b; line-height: 1.6;">{{ $step['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Image --}}
            <div class="hidden lg:block">
                @if($image)
                    <div style="position: relative; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
                        <img src="{{ asset('storage/' . $image) }}" alt="Our Process" style="width: 100%; height: auto; display: block; object-fit: contain;">
                    </div>
                @else
                    <div style="background: #f8fafc; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center;">
                        <i class="fa-solid fa-diagram-project" style="font-size: 80px; color: #e2e8f0; margin-bottom: 20px; display: block;"></i>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Structured Workflow</h4>
                        <p style="font-size: 14px; color: #64748b;">We follow a rigorous development lifecycle to ensure quality delivery.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
