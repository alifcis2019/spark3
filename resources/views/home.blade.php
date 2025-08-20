{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', __('messages.main_title'))
@section('meta_description', __('messages.main_subtitle'))

@php
$homeImage = \App\Models\SiteSetting::get('home_hero');
@endphp

@section('content')

<!-- Hero Section with Image Slider -->
<section class="relative min-h-screen bg-gray-900 text-white overflow-hidden">
    <!-- Background Slider -->
    <div class="absolute inset-0 z-0">
        <div class="hero-slider w-full h-full">
            {{-- Replace with your actual image paths --}}
            <div class="slide active w-full h-full" style="background-image: url('{{ Storage::url($homeImage) }}')"></div>
        </div>
        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gray-900 opacity-60"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 flex items-center min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 animate-fade-in">
                    {{ __('messages.main_title') }}
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-gray-200 animate-slide-up" style="animation-delay: 0.2s;">
                    {{ __('messages.main_subtitle') }}
                </p>

                <!-- Main Features Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10 text-sm md:text-base animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 flex flex-col items-center justify-center">
                        <i class="fas fa-cogs text-secondary text-2xl mb-2"></i>
                        <div class="font-semibold">{{ app()->getLocale() == 'ar' ? 'حلول برمجية' : 'Software Solutions' }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 flex flex-col items-center justify-center">
                        <i class="fas fa-cloud-upload-alt text-secondary text-2xl mb-2"></i>
                        <div class="font-semibold">{{ app()->getLocale() == 'ar' ? 'خدمات سحابية' : 'Cloud Services' }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 flex flex-col items-center justify-center">
                        <i class="fas fa-shield-alt text-secondary text-2xl mb-2"></i>
                        <div class="font-semibold">{{ app()->getLocale() == 'ar' ? 'أمن سيبراني' : 'Cyber Security' }}</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 flex flex-col items-center justify-center">
                        <i class="fas fa-chart-line text-secondary text-2xl mb-2"></i>
                        <div class="font-semibold">{{ app()->getLocale() == 'ar' ? 'تحليل بيانات' : 'Data Analytics' }}</div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up" style="animation-delay: 0.6s;">
                    <a href="{{ route('services.index') }}" class="bg-brand-gradient text-white px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        {{ __('messages.explore_services') }}
                    </a>
                    <a href="{{ route('contact') }}" class="bg-white/10 border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-primary transition-all duration-300">
                        {{ __('messages.free_consultation') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Navigation -->
    <!-- <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
        <button class="slider-dot active" data-slide="0"></button>
        <button class="slider-dot" data-slide="1"></button>
        <button class="slider-dot" data-slide="2"></button>
    </div> -->
</section>

<!-- Quick Stats Banner -->
<section class="bg-brand-gradient text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="animate-on-scroll">
                <div class="text-4xl md:text-5xl font-bold mb-2">500+</div>
                <div class="text-gray-200">{{ __('messages.satisfied_clients') }}</div>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-4xl md:text-5xl font-bold mb-2">10+</div>
                <div class="text-gray-200">{{ __('messages.years_experience') }}</div>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-4xl md:text-5xl font-bold mb-2">1000+</div>
                <div class="text-gray-200">{{ __('messages.completed_projects') }}</div>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                <div class="text-gray-200">{{ __('messages.technical_support') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Services -->
@if($featuredServices->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.our_services') }}</h2>
            <p class="text-xl text-gray-600">{{ __('messages.comprehensive_solutions') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredServices as $service)
            <div class="service-card bg-white rounded-xl overflow-hidden card-hover border border-gray-200">
                <div class="p-6">
                    <div class="service-icon mb-4">
                        @if($service->icon) <i class="{{ $service->icon }}"></i> @else <i class="fas fa-cogs"></i> @endif
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        {{ app()->getLocale() == 'ar' ? $service->title : $service->title_en ?? $service->title }}
                    </h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        {{ app()->getLocale() == 'ar' ? Str::limit($service->description, 100) : Str::limit($service->description_en ?? $service->description, 100) }}
                    </p>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition-colors group">
                        {{ __('messages.read_more') }}
                        <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }} transition-transform group-hover:{{ app()->getLocale() == 'ar' ? '-translate-x-1' : 'translate-x-1' }}"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Why Choose Us -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.why_choose_us') }}</h2>
            <p class="text-xl text-gray-600">{{ __('messages.best_choice') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center p-8 rounded-2xl shadow-lg bg-gray-50">
                <div class="bg-gradient-to-br from-blue-500 to-secondary w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-award text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ __('messages.certified_products') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{-- Your text here --}}</p>
            </div>
            <!-- Feature 2 -->
            <div class="text-center p-8 rounded-2xl shadow-lg bg-gray-50">
                <div class="bg-gradient-to-br from-green-500 to-green-400 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-users-cog text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ __('messages.expert_team') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{-- Your text here --}}</p>
            </div>
            <!-- Feature 3 -->
            <div class="text-center p-8 rounded-2xl shadow-lg bg-gray-50">
                <div class="bg-gradient-to-br from-primary to-secondary w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-headset text-primary text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ __('messages.support_247') }}</h3>
                <p class="text-gray-600 leading-relaxed">{{-- Your text here --}}</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gray-800 text-white relative">
    <div class="absolute inset-0 hero-pattern opacity-5"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl font-bold mb-6">{{-- Your CTA Title --}}</h2>
            <p class="text-xl text-gray-300 mb-8 leading-relaxed">{{-- Your CTA Subtitle --}}</p>
            <a href="{{ route('contact') }}" class="bg-brand-gradient text-white px-10 py-4 rounded-lg font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                {{ __('messages.free_consultation') }}
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Slider
        const slides = document.querySelectorAll('.slide');
        if (slides.length > 0) {
            const dots = document.querySelectorAll('.slider-dot');
            let currentSlide = 0;
            let slideInterval = setInterval(nextSlide, 5000);

            function showSlide(index) {
                slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
                dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const slideIndex = parseInt(dot.dataset.slide);
                    if (slideIndex !== currentSlide) {
                        currentSlide = slideIndex;
                        showSlide(currentSlide);
                        clearInterval(slideInterval);
                        slideInterval = setInterval(nextSlide, 5000);
                    }
                });
            });
        }

        // Intersection Observer for animations
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