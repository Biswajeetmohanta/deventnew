@props(['title', 'steps' => [], 'image' => ''])

@if(count($steps) > 0)
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Timeline --}}
            <div>
                <div style="margin-bottom: 40px;">
                    <div style="width: 40px; height: 3px; background: #3b82f6; border-radius: 2px; margin-bottom: 20px;"></div>
                    <h2 style="font-size: clamp(1.5rem, 2.5vw, 2rem); font-weight: 800; color: #0f172a; line-height: 1.2;">{{ $title }}</h2>
                </div>

                <div style="position: relative; padding-left: 32px; border-left: 2px dashed #e2e8f0;">
                    @foreach($steps as $index => $step)
                        <div style="position: relative; margin-bottom: 40px; {{ $loop->last ? 'margin-bottom: 0;' : '' }}">
                            {{-- Timeline Dot --}}
                            <div style="position: absolute; left: -41px; top: 0; width: 16px; height: 16px; background: #fff; border: 3px solid #3b82f6; border-radius: 50%; z-index: 1;"></div>
                            
                            <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">{{ $step['title'] ?? '' }}</h3>
                            <p style="font-size: 14px; color: #64748b; line-height: 1.6;">{{ $step['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Side: Image/Visual --}}
            <div class="hidden lg:block">
                @if($image)
                    <div style="position: relative; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
                        <img src="{{ asset('storage/' . $image) }}" alt="Our Process" style="width: 100%; height: auto; display: block;">
                    </div>
                @else
                    <div style="background: #fff; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center;">
                        <i class="fa-solid fa-diagram-project" style="font-size: 80px; color: #eff6ff; margin-bottom: 20px; display: block;"></i>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Structured Workflow</h4>
                        <p style="font-size: 14px; color: #64748b;">We follow a rigorous development lifecycle to ensure quality delivery.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
