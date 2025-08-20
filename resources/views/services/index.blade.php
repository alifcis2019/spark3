{{-- resources/views/services/index.blade.php --}}
@extends('layouts.app')

@section('title', __('messages.our_services') . ' - ' . \App\Models\SiteSetting::get('company_name', 'Spark'))
@section('meta_description', __('messages.services_meta_description'))

@section('content')

<!-- Page Header -->
<section class="bg-brand-gradient text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in">{{ __('messages.our_services') }}</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto animate-slide-up" style="animation-delay: 0.2s;">
            {{ __('messages.services_subtitle') }}
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        @if(isset($services) && $services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover flex flex-col">
                <div class="p-8 flex-grow">
                    <div class="mb-5">
                        <div class="w-16 h-16 bg-brand-gradient rounded-2xl flex items-center justify-center shadow-lg">
                            @if($service->icon)
                            <i class="{{ $service->icon }} text-white text-3xl"></i>
                            @else
                            <i class="fas fa-cogs text-white text-3xl"></i>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        {{ app()->getLocale() == 'ar' ? $service->title : $service->title_en ?? $service->title }}
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed flex-grow">
                        {{ app()->getLocale() == 'ar' ? Str::limit($service->description, 120) : Str::limit($service->description_en ?? $service->description, 120) }}
                    </p>
                </div>
                <div class="p-8 pt-0 bg-gray-50/50">
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition-colors group">
                        {{ __('messages.read_more') }}
                        <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }} transition-transform group-hover:{{ app()->getLocale() == 'ar' ? '-translate-x-1' : 'translate-x-1' }}"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($services->hasPages())
        <div class="mt-16">
            {{ $services->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-cogs text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">{{ __('messages.no_services_available') }}</h3>
            <p class="text-gray-500 mb-6">{{ __('messages.services_coming_soon') }}</p>
            <a href="{{ route('contact') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-all duration-300">
                {{ __('messages.contact_us') }}
            </a>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">{{ __('messages.need_consultation') }}</h2>
        <p class="text-xl mb-8 text-gray-300">{{ __('messages.cta_subtitle_services') }}</p>
        <a href="{{ route('contact') }}" class="bg-brand-gradient text-white px-8 py-4 rounded-lg font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            {{ __('messages.contact_us_now') }}
        </a>
    </div>
</section>
@endsection