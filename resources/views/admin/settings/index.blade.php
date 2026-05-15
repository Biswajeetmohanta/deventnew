@extends('admin.layouts.admin')

@section('title', 'Site Settings')
@section('page_title', 'Configuration Dashboard')

@section('content')
<div class="max-w-6xl mx-auto" x-data="{ activeTab: '{{ request()->get('tab', 'hero') }}' }">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1 space-y-2">
            <button @click="activeTab = 'hero'" 
                :class="activeTab === 'hero' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-house-chimney mr-3 text-lg"></i>
                Hero Section
            </button>
            <button @click="activeTab = 'counters'" 
                :class="activeTab === 'counters' ? 'bg-purple-600 text-white shadow-lg shadow-purple-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-arrow-trend-up mr-3 text-lg"></i>
                Counters
            </button>
            <button @click="activeTab = 'about'" 
                :class="activeTab === 'about' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-circle-info mr-3 text-lg"></i>
                About Us
            </button>
            <button @click="activeTab = 'branding'" 
                :class="activeTab === 'branding' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-paint-roller mr-3 text-lg"></i>
                Branding
            </button>
            <button @click="activeTab = 'contact'" 
                :class="activeTab === 'contact' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-address-book mr-3 text-lg"></i>
                Contact & Social
            </button>
            <button @click="activeTab = 'technology'" 
                :class="activeTab === 'technology' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-microchip mr-3 text-lg"></i>
                Technology Page
            </button>
            <button @click="activeTab = 'chatbot'" 
                :class="activeTab === 'chatbot' ? 'bg-cyan-600 text-white shadow-lg shadow-cyan-200' : 'bg-white text-slate-600 hover:bg-slate-50'"
                class="w-full flex items-center px-6 py-4 rounded-2xl transition-all duration-300 font-bold text-sm">
                <i class="fa-solid fa-robot mr-3 text-lg"></i>
                Chatbot Settings
            </button>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-3">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Hero Section -->
                <div x-show="activeTab === 'hero'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-house-chimney text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Hero Section</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Homepage landing area</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="hero_tagline">Hero Tagline</label>
                            <input type="text" name="hero_tagline" id="hero_tagline" value="{{ $settings['hero_tagline'] ?? '' }}" placeholder="e.g. INNOVATIVE TECH SOLUTIONS">
                        </div>
                        <div>
                            <label for="hero_subtitle">Hero Subtitle</label>
                            <textarea name="hero_subtitle" id="hero_subtitle" rows="3" placeholder="Describe your mission briefly...">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="hero_stats_count">Stats Count</label>
                                <input type="text" name="hero_stats_count" id="hero_stats_count" value="{{ $settings['hero_stats_count'] ?? '' }}" placeholder="e.g. 100+">
                            </div>
                            <div>
                                <label for="hero_stats_text">Stats Description</label>
                                <input type="text" name="hero_stats_text" id="hero_stats_text" value="{{ $settings['hero_stats_text'] ?? '' }}" placeholder="e.g. PROJECTS DELIVERED">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-4">Hero Featured Image</label>
                            <div class="flex items-center space-x-6 p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                                @if(isset($settings['hero_image']))
                                    <img src="{{ asset('storage/' . $settings['hero_image']) }}" class="h-24 w-32 object-cover rounded-2xl shadow-md" alt="Hero">
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="hero_image" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="mt-2 text-xs text-slate-400">Recommended: 1200x800px, PNG or JPG</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Counters Section -->
                <div x-show="activeTab === 'counters'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-arrow-trend-up text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Counters Section</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Animated statistics counters</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="bg-slate-50 p-6 rounded-2xl mb-4">
                                <h5 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">Counter {{ $i }}</h5>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="counter_{{ $i }}_value" class="text-xs">Value</label>
                                        <input type="text" name="counter_{{ $i }}_value" id="counter_{{ $i }}_value" value="{{ $settings['counter_' . $i . '_value'] ?? '' }}" placeholder="e.g. 100+">
                                    </div>
                                    <div>
                                        <label for="counter_{{ $i }}_label" class="text-xs">Label</label>
                                        <input type="text" name="counter_{{ $i }}_label" id="counter_{{ $i }}_label" value="{{ $settings['counter_' . $i . '_label'] ?? '' }}" placeholder="e.g. Projects Delivered">
                                    </div>
                                    <div>
                                        <label for="counter_{{ $i }}_icon" class="text-xs">Icon Class</label>
                                        <input type="text" name="counter_{{ $i }}_icon" id="counter_{{ $i }}_icon" value="{{ $settings['counter_' . $i . '_icon'] ?? '' }}" placeholder="e.g. fa-solid fa-check">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Technology Page Settings -->
                <div x-show="activeTab === 'technology'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-microchip text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Technology Page</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Tech stack page configuration</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="tech_hero_title">Hero Title</label>
                            <input type="text" name="tech_hero_title" id="tech_hero_title" value="{{ $settings['tech_hero_title'] ?? '' }}" placeholder="e.g. Our Tech Stack">
                        </div>
                        <div>
                            <label for="tech_hero_subtitle">Hero Subtitle</label>
                            <textarea name="tech_hero_subtitle" id="tech_hero_subtitle" rows="3" placeholder="Describe your expertise...">{{ $settings['tech_hero_subtitle'] ?? '' }}</textarea>
                        </div>
                        <hr class="border-slate-100 my-8">
                        <div>
                            <label for="tech_cta_title">CTA Title</label>
                            <input type="text" name="tech_cta_title" id="tech_cta_title" value="{{ $settings['tech_cta_title'] ?? '' }}" placeholder="e.g. Need a custom tech solution?">
                        </div>
                        <div>
                            <label for="tech_cta_subtitle">CTA Subtitle</label>
                            <textarea name="tech_cta_subtitle" id="tech_cta_subtitle" rows="3" placeholder="CTA description...">{{ $settings['tech_cta_subtitle'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- About Us Section -->
                <div x-show="activeTab === 'about'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-circle-info text-emerald-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">About Us Section</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Company profile area</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="about_badge">About Badge</label>
                            <input type="text" name="about_badge" id="about_badge" value="{{ $settings['about_badge'] ?? '' }}" placeholder="e.g. WHO WE ARE">
                        </div>
                        <div>
                            <label for="about_description">About Description</label>
                            <textarea name="about_description" id="about_description" rows="4" placeholder="Enter the main about description...">{{ $settings['about_description'] ?? '' }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="about_exp_years">Experience Years</label>
                                <input type="text" name="about_exp_years" id="about_exp_years" value="{{ $settings['about_exp_years'] ?? '' }}" placeholder="e.g. 10+">
                            </div>
                            <div>
                                <label for="about_exp_text">Experience Text</label>
                                <input type="text" name="about_exp_text" id="about_exp_text" value="{{ $settings['about_exp_text'] ?? '' }}" placeholder="e.g. YEARS OF EXPERIENCE">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-slate-700">Statistic 1</label>
                                <input type="text" name="about_stat1_count" value="{{ $settings['about_stat1_count'] ?? '' }}" placeholder="Count (e.g. 50+)">
                                <input type="text" name="about_stat1_text" value="{{ $settings['about_stat1_text'] ?? '' }}" placeholder="Label (e.g. EXPERTS)">
                            </div>
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-slate-700">Statistic 2</label>
                                <input type="text" name="about_stat2_count" value="{{ $settings['about_stat2_count'] ?? '' }}" placeholder="Count (e.g. 200+)">
                                <input type="text" name="about_stat2_text" value="{{ $settings['about_stat2_text'] ?? '' }}" placeholder="Label (e.g. CLIENTS)">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-4">About Featured Image</label>
                            <div class="flex items-center space-x-6 p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                                @if(isset($settings['about_image']))
                                    <img src="{{ asset('storage/' . $settings['about_image']) }}" class="h-24 w-32 object-cover rounded-2xl shadow-md" alt="About">
                                @endif
                                <div class="flex-1">
                                    <input type="file" name="about_image" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branding Section -->
                <div x-show="activeTab === 'branding'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-paint-roller text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Branding & Identity</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Logos and site identity</p>
                        </div>
                    </div>
                    
                    <div class="space-y-8">
                        <div>
                            <label for="site_name">Website Name</label>
                            <input type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] ?? '' }}" placeholder="e.g. Devent Technologies">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 text-center">
                                <label class="block text-xs uppercase tracking-[0.2em] font-black mb-6">Main Logo</label>
                                <div class="mb-6 h-20 flex items-center justify-center">
                                    @if(isset($settings['site_logo']))
                                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" class="max-h-full" alt="Logo">
                                    @else
                                        <i class="fa-solid fa-image text-slate-200 text-5xl"></i>
                                    @endif
                                </div>
                                <input type="file" name="site_logo" class="text-xs text-slate-500 w-full">
                            </div>
                            <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 text-center">
                                <label class="block text-xs uppercase tracking-[0.2em] font-black mb-6">Favicon</label>
                                <div class="mb-6 h-20 flex items-center justify-center">
                                    @if(isset($settings['site_favicon']))
                                        <img src="{{ asset('storage/' . $settings['site_favicon']) }}" class="h-12 w-12" alt="Favicon">
                                    @else
                                        <i class="fa-solid fa-bolt text-slate-200 text-4xl"></i>
                                    @endif
                                </div>
                                <input type="file" name="site_favicon" class="text-xs text-slate-500 w-full">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact & Social Section -->
                <div x-show="activeTab === 'contact'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-address-book text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Contact & Social</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Connect with users</p>
                        </div>
                    </div>
                    
                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_email">Contact Email</label>
                                <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" placeholder="contact@example.com">
                            </div>
                            <div>
                                <label for="contact_phone">Contact Phone</label>
                                <input type="text" name="contact_phone" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="+1 234 567 890">
                            </div>
                        </div>
                        <div>
                            <label for="address">Office Address</label>
                            <textarea name="address" id="address" rows="2" placeholder="Physical office address...">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach(['facebook' => 'Facebook', 'twitter' => 'Twitter/X', 'linkedin' => 'LinkedIn', 'instagram' => 'Instagram'] as $key => $label)
                                <div>
                                    <label>{{ $label }} URL</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-300">
                                            <i class="fa-brands fa-{{ $key === 'twitter' ? 'x-twitter' : $key }}"></i>
                                        </div>
                                        <input type="url" name="{{ $key }}_url" value="{{ $settings[$key . '_url'] ?? '' }}" class="pl-12" placeholder="https://{{ $key }}.com/...">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Chatbot Settings -->
                <div x-show="activeTab === 'chatbot'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="glass p-8 rounded-[2.5rem] shadow-xl border-slate-100">
                    <div class="flex items-center mb-10">
                        <div class="w-12 h-12 bg-cyan-50 rounded-2xl flex items-center justify-center mr-4">
                            <i class="fa-solid fa-robot text-cyan-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900">Chatbot Settings</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Automatic replies configuration</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="chatbot_ai_enabled">Enable AI Responses</label>
                            <select name="chatbot_ai_enabled" id="chatbot_ai_enabled">
                                <option value="0" {{ ($settings['chatbot_ai_enabled'] ?? '0') == '0' ? 'selected' : '' }}>Disabled</option>
                                <option value="1" {{ ($settings['chatbot_ai_enabled'] ?? '0') == '1' ? 'selected' : '' }}>Enabled</option>
                            </select>
                            <p class="mt-2 text-xs text-slate-400">When enabled, the chatbot will use Gemini API to generate responses.</p>
                        </div>
                        <div>
                            <label for="gemini_api_key">Gemini API Key</label>
                            <input type="text" name="gemini_api_key" id="gemini_api_key" value="{{ $settings['gemini_api_key'] ?? '' }}" placeholder="Enter your Gemini API key">
                            <p class="mt-2 text-xs text-slate-400">Required if AI Responses are enabled. You can get a free key from Google AI Studio.</p>
                        </div>
                        
                        <hr class="border-slate-100 my-8">
                        
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center mr-3">
                                <i class="fa-solid fa-envelope-open-text text-indigo-600"></i>
                            </div>
                            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Email Notifications</h4>
                        </div>
                        
                        <div>
                            <label for="chatbot_notification_email">Notification Recipient Email</label>
                            <input type="email" name="chatbot_notification_email" id="chatbot_notification_email" value="{{ $settings['chatbot_notification_email'] ?? '' }}" placeholder="e.g. jyoti@deventtechnology.com">
                            <p class="mt-2 text-xs text-slate-400">New visitor messages will be sent to this email.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-3xl mt-6">
                            <div class="md:col-span-2">
                                <h5 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Brevo API Configuration (For Sending)</h5>
                            </div>
                            <div class="md:col-span-2">
                                <label for="brevo_api_key" class="text-xs">Brevo API Key</label>
                                <input type="text" name="brevo_api_key" id="brevo_api_key" value="{{ $settings['brevo_api_key'] ?? '' }}" placeholder="Enter Brevo API Key">
                            </div>
                            <div class="md:col-span-2">
                                <label for="mail_from_address" class="text-xs">Send From Address</label>
                                <input type="email" name="mail_from_address" id="mail_from_address" value="{{ $settings['mail_from_address'] ?? '' }}" placeholder="e.g. noreply@devent.com">
                            </div>
                        </div>
                        
                        <hr class="border-slate-100 my-8">
                        
                        <div>
                            <h4 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider">Keyword Replies</h4>
                            <p class="text-xs text-slate-500 mb-4">You can manage fixed replies based on keywords in the dedicated section.</p>
                            <a href="{{ route('admin.chat-auto-replies.index') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-700">
                                <i class="fa-solid fa-list-check mr-2"></i>
                                Manage Keyword Replies
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Global Save Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-black px-12 py-5 rounded-[2rem] transition-all shadow-2xl shadow-slate-200 active:scale-95 flex items-center group">
                        <i class="fa-solid fa-cloud-arrow-up mr-3 text-xl group-hover:animate-bounce"></i>
                        Update Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Alpine.js for Tab Switching -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
