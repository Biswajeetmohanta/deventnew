@extends('layouts.app')

@section('title', 'Project Cost Calculator & Price Estimator | Devent Technology')
@section('meta_description', 'Estimate your custom software, mobile app, or web platform development costs online with Devent Technology\'s interactive project price calculator.')

@section('content')
<section class="py-24 bg-slate-50 min-h-screen relative overflow-hidden">
    <!-- Background Blur Decorative Elements -->
    <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50 -z-10"></div>
    <div class="absolute bottom-1/4 right-1/10 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50 -z-10"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#0052FF] font-black uppercase tracking-[0.3em] text-[10px] bg-blue-50 px-4 py-2 rounded-full">Estimate Tool</span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mt-4 mb-6 tracking-tight leading-tight">
                Calculate Your Project <span class="text-[#0052FF]">Cost Estimate</span>
            </h1>
            <p class="text-lg text-slate-500 font-medium">
                Get an instant pricing estimate for your next development project. Select the options below, and we will calculate a realistic ballpark cost and timeline.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Step wizard form -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-xl border border-slate-100">
                <!-- Progress bar -->
                <div class="mb-8">
                    <div class="flex justify-between items-center text-xs font-black uppercase text-slate-400 mb-2">
                        <span>Progress</span>
                        <span id="step-indicator">Step 1 of 5</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div id="progress-bar" class="bg-[#0052FF] h-full transition-all duration-500 ease-out" style="width: 20%;"></div>
                    </div>
                </div>

                <!-- FORM -->
                <form id="calculator-form">
                    @csrf
                    
                    <!-- STEP 1: Project Type -->
                    <div class="step-pane" data-step="1">
                        <h2 class="text-2xl font-black text-slate-800 mb-2">What are we building?</h2>
                        <p class="text-sm text-slate-400 mb-6 font-medium">Choose the platform that best fits your product idea.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($projectTypes as $index => $type)
                                <label class="project-type-card cursor-pointer border-2 border-slate-100 hover:border-blue-300 rounded-2xl p-5 block transition-all relative">
                                    <input type="radio" name="project_type" value="{{ $type->key }}" class="hidden" {{ $index === 0 ? 'checked' : '' }}>
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#0052FF] flex items-center justify-center text-xl font-bold">
                                            <i class="{{ $type->icon ?? 'fa-solid fa-laptop-code' }}"></i>
                                        </div>
                                        <div>
                                            <span class="block font-black text-slate-800">{{ $type->name }}</span>
                                            <span class="text-xs text-slate-400 font-medium">{{ $type->description }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- STEP 2: Complexity -->
                    <div class="step-pane hidden" data-step="2">
                        <h2 class="text-2xl font-black text-slate-800 mb-2">Design & Complexity Level</h2>
                        <p class="text-sm text-slate-400 mb-6 font-medium">Select the level of visual polish and design uniqueness required.</p>
                        
                        <div class="flex flex-col gap-4">
                            @foreach($complexities as $index => $comp)
                                <label class="complexity-card cursor-pointer border-2 border-slate-100 hover:border-blue-300 rounded-2xl p-5 block transition-all">
                                    <input type="radio" name="complexity" value="{{ $comp->key }}" class="hidden" {{ $index === 0 ? 'checked' : '' }}>
                                    <div class="flex items-start gap-4">
                                        <div class="w-6 h-6 rounded-full border-2 border-slate-200 flex-shrink-0 flex items-center justify-center mt-1">
                                            <div class="w-3 h-3 bg-[#0052FF] rounded-full scale-0 transition-all duration-200"></div>
                                        </div>
                                        <div>
                                            <span class="block font-black text-slate-800">{{ $comp->name }}</span>
                                            <span class="text-sm text-slate-400 font-medium block mt-1">{{ $comp->description }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- STEP 3: Key Features -->
                    <div class="step-pane hidden" data-step="3">
                        <h2 class="text-2xl font-black text-slate-800 mb-2">Select Core Features</h2>
                        <p class="text-sm text-slate-400 mb-6 font-medium">Tick the functional blocks your product requires.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($features as $feat)
                                <label class="feature-card cursor-pointer border-2 border-slate-100 hover:border-blue-300 rounded-2xl p-4 block transition-all">
                                    <input type="checkbox" name="features[]" value="{{ $feat->key }}" class="hidden">
                                    <div class="flex items-center gap-4">
                                        <div class="w-5 h-5 rounded border border-slate-300 flex-shrink-0 flex items-center justify-center">
                                            <i class="fa-solid fa-check text-white text-[10px] scale-0 transition-transform"></i>
                                        </div>
                                        <div>
                                            <span class="block font-black text-slate-800 text-sm">{{ $feat->name }}</span>
                                            <span class="text-xs text-slate-400 font-medium">{{ $feat->description }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- STEP 4: Screens & Urgency -->
                    <div class="step-pane hidden" data-step="4">
                        <h2 class="text-2xl font-black text-slate-800 mb-2">Project Scale & Timeline</h2>
                        <p class="text-sm text-slate-400 mb-6 font-medium">Rough scope sizing helps calculate development timelines.</p>
                        
                        <div class="mb-6">
                            <span class="block text-slate-700 font-bold mb-3">Project Page Count / Screens</span>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach($screens as $index => $scr)
                                    <label class="scale-card cursor-pointer border border-slate-200 rounded-xl p-3 text-center block transition-all">
                                        <input type="radio" name="screens" value="{{ $scr->key }}" class="hidden" {{ $index === 0 ? 'checked' : '' }}>
                                        <span class="font-bold text-slate-800 block">{{ $scr->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <span class="block text-slate-700 font-bold mb-3">Target Launch Timeline</span>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach($timelines as $index => $time)
                                    <label class="timeline-card cursor-pointer border border-slate-200 rounded-xl p-4 block transition-all">
                                        <input type="radio" name="urgency" value="{{ $time->key }}" class="hidden" {{ $index === 0 ? 'checked' : '' }}>
                                        <span class="font-bold text-slate-800 block">{{ $time->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- STEP 5: Final Submission Details -->
                    <div class="step-pane hidden" data-step="5">
                        <h2 class="text-2xl font-black text-slate-800 mb-2">Request Detailed Proposal</h2>
                        <p class="text-sm text-slate-400 mb-6 font-medium">Leave your contact details so our team can follow up with a customized solution plan.</p>
                        
                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-1">Your Name *</label>
                                <input type="text" name="name" required class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#0052FF] font-medium text-slate-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-1">Email Address *</label>
                                <input type="email" name="email" required class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#0052FF] font-medium text-slate-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-1">Phone Number (Optional)</label>
                                <input type="text" name="phone" class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#0052FF] font-medium text-slate-800">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between items-center mt-10 pt-6 border-t border-slate-100">
                        <button type="button" id="prev-btn" class="px-6 py-3 border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-colors hidden">
                            Back
                        </button>
                        <div class="ml-auto flex gap-3">
                            <button type="button" id="next-btn" class="px-6 py-3 bg-[#0052FF] text-white font-bold rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-blue-100">
                                Continue
                            </button>
                            <button type="submit" id="submit-btn" class="px-6 py-3 bg-[#0052FF] text-white font-bold rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-blue-100 hidden">
                                Submit Inquiry
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Price Output & Feedback -->
            <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden lg:sticky lg:top-24">
                <!-- Background ambient lights -->
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-blue-600 rounded-full blur-[80px] opacity-40"></div>
                <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-indigo-500 rounded-full blur-[80px] opacity-40"></div>

                <div class="relative z-10">
                    <h3 class="text-sm font-black text-[#0052FF] uppercase tracking-widest mb-6">Price Estimate</h3>
                    
                    <div class="mb-8">
                        <span class="text-slate-400 text-xs font-bold block mb-1">Estimated Project Value</span>
                        <div class="text-3xl md:text-4xl font-black tracking-tight mb-2">
                            <span id="price-display">$0</span>
                        </div>
                        <p class="text-xs text-slate-400 font-medium">This estimate is a ballpark range. Final costs depend on system architecture details.</p>
                    </div>

                    <div class="border-t border-slate-800 pt-6 mb-6">
                        <span class="text-slate-400 text-xs font-bold block mb-3">Timeline Summary</span>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-800 text-blue-400 flex items-center justify-center">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div>
                                <span class="block text-sm font-bold" id="timeline-display">-</span>
                                <span class="block text-[10px] text-slate-500 font-semibold uppercase tracking-wider">Project Timeline</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-800 pt-6">
                        <span class="text-slate-400 text-xs font-bold block mb-3">Selections Overview</span>
                        <ul class="flex flex-col gap-2 text-xs font-medium text-slate-300" id="selection-summary">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Javascript Logic -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('calculator-form');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    const steps = document.querySelectorAll('.step-pane');
    const progress = document.getElementById('progress-bar');
    const stepIndicator = document.getElementById('step-indicator');
    
    // UI displays
    const priceDisplay = document.getElementById('price-display');
    const timelineDisplay = document.getElementById('timeline-display');
    const selectionSummary = document.getElementById('selection-summary');

    let currentStep = 1;
    const totalSteps = 5;

    // INJECT DYNAMIC CONFIGURATIONS FROM DATABASE
    const basePrices = {
        @foreach($projectTypes as $type)
            '{{ $type->key }}': { min: {{ $type->min_price }}, max: {{ $type->max_price }}, name: '{{ $type->name }}' },
        @endforeach
    };

    const complexityMultipliers = {
        @foreach($complexities as $comp)
            '{{ $comp->key }}': { mult: {{ $comp->multiplier }}, name: '{{ $comp->name }}' },
        @endforeach
    };

    const featureCosts = {
        @foreach($features as $feat)
            '{{ $feat->key }}': { min: {{ $feat->min_price }}, max: {{ $feat->max_price }}, name: '{{ $feat->name }}' },
        @endforeach
    };

    const screenMultipliers = {
        @foreach($screens as $scr)
            '{{ $scr->key }}': { mult: {{ $scr->multiplier }}, name: '{{ $scr->name }}' },
        @endforeach
    };

    const urgencyTimeline = {
        @foreach($timelines as $time)
            '{{ $time->key }}': { mult: {{ $time->multiplier }}, duration: '{{ $time->duration }}', name: '{{ $time->name }}' },
        @endforeach
    };

    // Calculate Price and Update UI
    function calculate() {
        const formData = new FormData(form);
        const type = formData.get('project_type');
        const complexity = formData.get('complexity');
        const screens = formData.get('screens');
        const urgency = formData.get('urgency');

        if(!type || !complexity || !screens || !urgency) return;
        
        // Base min & max
        let minCost = basePrices[type].min;
        let maxCost = basePrices[type].max;

        // Features add
        const features = formData.getAll('features[]');
        features.forEach(feat => {
            if (featureCosts[feat]) {
                minCost += featureCosts[feat].min;
                maxCost += featureCosts[feat].max;
            }
        });

        // Multipliers
        const compMult = complexityMultipliers[complexity].mult;
        const scrMult = screenMultipliers[screens].mult;
        const urgMult = urgencyTimeline[urgency].mult;

        minCost = Math.round(minCost * compMult * scrMult * urgMult);
        maxCost = Math.round(maxCost * compMult * scrMult * urgMult);

        // Update displays
        priceDisplay.textContent = `$${minCost.toLocaleString()} - $${maxCost.toLocaleString()}`;
        timelineDisplay.textContent = urgencyTimeline[urgency].duration;

        // Store current calculated values as hidden form fields to submit
        let minInput = document.getElementById('estimate_min_input');
        let maxInput = document.getElementById('estimate_max_input');
        if(!minInput) {
            minInput = document.createElement('input');
            minInput.type = 'hidden';
            minInput.name = 'estimate_min';
            minInput.id = 'estimate_min_input';
            form.appendChild(minInput);
        }
        if(!maxInput) {
            maxInput = document.createElement('input');
            maxInput.type = 'hidden';
            maxInput.name = 'estimate_max';
            maxInput.id = 'estimate_max_input';
            form.appendChild(maxInput);
        }
        minInput.value = minCost;
        maxInput.value = maxCost;

        // Render Overview selections list
        let summaryHtml = `<li><i class="fa-solid fa-circle-check text-[#0052FF] mr-2"></i> ${basePrices[type].name}</li>`;
        summaryHtml += `<li><i class="fa-solid fa-circle-check text-[#0052FF] mr-2"></i> ${complexityMultipliers[complexity].name}</li>`;
        
        features.forEach(feat => {
            if (featureCosts[feat]) {
                summaryHtml += `<li><i class="fa-solid fa-circle-check text-[#0052FF] mr-2"></i> + ${featureCosts[feat].name}</li>`;
            }
        });

        summaryHtml += `<li><i class="fa-solid fa-circle-check text-[#0052FF] mr-2"></i> ${screenMultipliers[screens].name}</li>`;
        summaryHtml += `<li><i class="fa-solid fa-circle-check text-[#0052FF] mr-2"></i> ${urgencyTimeline[urgency].name}</li>`;

        selectionSummary.innerHTML = summaryHtml;
    }

    // Step Navigations
    function updateStep() {
        // Show/hide panes
        steps.forEach(step => {
            if (parseInt(step.dataset.step) === currentStep) {
                step.classList.remove('hidden');
            } else {
                step.classList.add('hidden');
            }
        });

        // Update progress indicators
        const percent = (currentStep / totalSteps) * 100;
        progress.style.width = percent + '%';
        stepIndicator.textContent = `Step ${currentStep} of ${totalSteps}`;

        // Back button visibility
        if (currentStep > 1) {
            prevBtn.classList.remove('hidden');
        } else {
            prevBtn.classList.add('hidden');
        }

        // Action button visibility
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }

    nextBtn.addEventListener('click', function() {
        if (currentStep < totalSteps) {
            currentStep++;
            updateStep();
        }
    });

    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateStep();
        }
    });

    // Handle form change to update price range instantly
    form.addEventListener('change', calculate);

    // Form Submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Ensure price estimate fields are added
        calculate();

        const formData = new FormData(form);
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Submitting...';

        fetch('{{ url("/price-calculator/submit") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Success popup/render
                form.innerHTML = `
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center text-4xl mx-auto mb-6 shadow-lg shadow-green-100">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 mb-2">Estimate Submitted Successfully!</h3>
                        <p class="text-slate-500 font-medium max-w-md mx-auto mb-8">${data.message}</p>
                        <a href="{{ url('/') }}" class="px-6 py-3 bg-[#0052FF] text-white font-bold rounded-xl hover:bg-blue-600 transition-colors shadow-lg">Back to Homepage</a>
                    </div>
                `;
            } else {
                alert('Something went wrong. Please check fields and try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Inquiry';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong. Please try again.');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Inquiry';
        });
    });

    // Run initial calculation
    calculate();
});
</script>

<style>
/* Custom Interactive Styling for Calculator Cards */
.project-type-card, .complexity-card, .feature-card, .scale-card, .timeline-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Radio Checked Styles */
input[type="radio"]:checked + div,
input[type="radio"]:checked + span,
input[type="radio"]:checked + .font-bold {
    color: #0052FF;
}

/* Card Selection Indicators */
.project-type-card:has(input[type="radio"]:checked),
.complexity-card:has(input[type="radio"]:checked),
.scale-card:has(input[type="radio"]:checked),
.timeline-card:has(input[type="radio"]:checked) {
    border-color: #0052FF;
    background-color: #f8fafc;
    box-shadow: 0 10px 20px -5px rgba(0, 82, 255, 0.05);
}

/* Complexity inner indicator radio check */
.complexity-card:has(input[type="radio"]:checked) .w-6 div {
    transform: scale(1);
}
.complexity-card:has(input[type="radio"]:checked) .w-6 {
    border-color: #0052FF;
}

/* Checkbox Checked Styles */
.feature-card:has(input[type="checkbox"]:checked) {
    border-color: #0052FF;
    background-color: #f8fafc;
}
.feature-card:has(input[type="checkbox"]:checked) .w-5 {
    background-color: #0052FF;
    border-color: #0052FF;
}
.feature-card:has(input[type="checkbox"]:checked) .w-5 i {
    transform: scale(1);
}
</style>
@endsection
