{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', __('messages.about_us') . ' - ' . \App\Models\SiteSetting::get('company_name', 'Spark'))
@section('meta_description', __('messages.about_us_meta_description'))
@php
$homeImage = \App\Models\SiteSetting::get('home_hero');
@endphp
@section('content')

<!-- Page Header -->
<section class="bg-brand-gradient text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in">{{ __('messages.about_us') }}</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto animate-slide-up" style="animation-delay: 0.2s;">
            {{ __('messages.about_us_subtitle') }}
        </p>
    </div>
</section>

<!-- Main About Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- About Content -->
            <div class="animate-on-scroll">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('messages.our_story') }}</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>{{ __('messages.our_story_p1') }}</p>
                    <p>{{ __('messages.our_story_p2') }}</p>
                </div>
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-blue-50 p-6 rounded-lg flex items-center gap-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <i class="fas fa-briefcase text-primary text-3xl"></i>
                        <div>
                            <div class="text-2xl font-bold text-primary">10+</div>
                            <div class="text-gray-600">{{ __('messages.years_experience') }}</div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg flex items-center gap-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <i class="fas fa-users text-green-600 text-3xl"></i>
                        <div>
                            <div class="text-2xl font-bold text-green-600">500+</div>
                            <div class="text-gray-600">{{ __('messages.satisfied_clients') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Image -->
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <img src="{{ Storage::url($homeImage) }}" alt="{{ __('messages.about_us') }}" class="rounded-2xl shadow-xl w-full aspect-square object-fit">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Mission -->
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center card-hover animate-on-scroll">
                <div class="bg-brand-gradient w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-rocket text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ __('messages.our_mission') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ __('messages.our_mission_text') }}</p>
            </div>

            <!-- Vision -->
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center card-hover animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-brand-gradient w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-eye text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ __('messages.our_vision') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ __('messages.our_vision_text') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.why_choose_us') }}</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">{{ __('messages.why_choose_us_subtitle') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 animate-on-scroll">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-award text-primary text-3xl"></i></div>
                <h3 class="text-xl font-bold mb-3">{{ __('messages.expertise') }}</h3>
                <p class="text-gray-600">{{ __('messages.expertise_text') }}</p>
            </div>
            <div class="text-center p-6 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-lightbulb text-green-600 text-3xl"></i></div>
                <h3 class="text-xl font-bold mb-3">{{ __('messages.innovation') }}</h3>
                <p class="text-gray-600">{{ __('messages.innovation_text') }}</p>
            </div>
            <div class="text-center p-6 animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-handshake text-purple-600 text-3xl"></i></div>
                <h3 class="text-xl font-bold mb-3">{{ __('messages.commitment') }}</h3>
                <p class="text-gray-600">{{ __('messages.commitment_text') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4 animate-on-scroll">{{ __('messages.ready_to_work_with_us') }}</h2>
        <p class="text-xl mb-8 text-gray-300 animate-on-scroll" style="animation-delay: 0.2s;">{{ __('messages.cta_subtitle') }}</p>
        <div class="animate-on-scroll" style="animation-delay: 0.4s;">
            <a href="{{ route('contact') }}" class="bg-brand-gradient text-white px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                {{ __('messages.contact_us_now') }}
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        animatedElements.forEach(el => observer.observe(el));
    });
</script>
@endpush
@endsection