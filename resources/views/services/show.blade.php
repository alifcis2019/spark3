{{-- resources/views/services/show.blade.php (UI Enhanced - Simple Logic) --}}
@extends('layouts.app')

@section('title', (app()->getLocale() == 'ar' ? $service->title : $service->title_en ?? $service->title) . ' - ' . \App\Models\SiteSetting::get('company_name', 'Spark'))
@section('meta_description', app()->getLocale() == 'ar' ? $service->description : $service->description_en ?? $service->description)
@push('css')
<style>
    .content-wrapper {
        max-width: 100%;
        overflow-wrap: break-word;
        /* لو فيه كلمات طويلة تكسر للسطر */
    }

    .content-wrapper img,
    .content-wrapper iframe,
    .content-wrapper table {
        max-width: 100% !important;
        /* يمنع كسر العرض */
        height: auto;
        /* يحافظ على التناسب */
        display: block;
    }
</style>
@endpush
@section('content')

<!-- Service Header -->
<section class="bg-brand-gradient text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in">
                <!-- Breadcrumbs -->
                <nav class="text-sm mb-4 font-semibold">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">{{ __('messages.home') }}</a>
                    <span class="mx-2 text-gray-400">/</span>
                    <a href="{{ route('services.index') }}" class="text-gray-300 hover:text-white">{{ __('messages.our_services') }}</a>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-white">{{ app()->getLocale() == 'ar' ? $service->title : $service->title_en ?? $service->title }}</span>
                </nav>

                <h1 class="text-4xl md:text-5xl font-extrabold mb-6">{{ app()->getLocale() == 'ar' ? $service->title : $service->title_en ?? $service->title }}</h1>
                <p class="text-xl text-gray-200 leading-relaxed">{{ app()->getLocale() == 'ar' ? $service->description : $service->description_en ?? $service->description }}</p>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('contact') }}" class="bg-white text-primary px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-200 transition-all duration-300 transform hover:-translate-y-1 text-center">
                        {{ __('messages.get_a_quote') }}
                    </a>
                    <a href="tel:{{ \App\Models\SiteSetting::get('phone', '') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-primary transition-all duration-300 text-center">
                        <i class="fas fa-phone {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('messages.call_us') }}
                    </a>
                </div>
            </div>

            <div class="hidden lg:block animate-fade-in" style="animation-delay: 0.2s;">
                @if($service->featured_image)
                <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->title }}" class="rounded-2xl shadow-2xl w-full aspect-[3/3] object-cover">
                @else
                <div class="bg-white/10 rounded-2xl shadow-2xl h-80 flex items-center justify-center">
                    @if($service->icon)
                    <i class="{{ $service->icon }} text-white text-8xl opacity-80"></i>
                    @else
                    <i class="fas fa-cogs text-white text-8xl opacity-80"></i>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Service Content & Sidebar -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-lg">
                <div class="prose prose-lg max-w-none prose-blue prose-headings:font-semibold overflow-hidden">
                    <div class="content-wrapper">
                        {!! app()->getLocale() == 'ar' ? $service->content : ($service->content_en ?? $service->content) !!}
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="space-y-8">
                <!-- Contact Card -->
                <div class="bg-brand-gradient text-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-2xl font-bold mb-4">{{ __('messages.need_help') }}</h3>
                    <p class="mb-6 text-gray-200">{{ __('messages.free_consultation_sidebar') }}</p>
                    <div class="space-y-3 mb-6">
                        @if($phone = \App\Models\SiteSetting::get('phone'))
                        <div class="flex items-center">
                            <i class="fas fa-phone w-6 text-center {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            <span>{{ $phone }}</span>
                        </div>
                        @endif
                        @if($email = \App\Models\SiteSetting::get('email'))
                        <div class="flex items-center">
                            <i class="fas fa-envelope w-6 text-center {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            <span>{{ $email }}</span>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('contact') }}" class="block w-full bg-white text-primary text-center py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-300">
                        {{ __('messages.contact_us') }}
                    </a>
                </div>

                <!-- Other Services -->
                @php
                $otherServices = \App\Models\Service::active()->where('id', '!=', $service->id)->inRandomOrder()->take(3)->get();
                @endphp
                @if($otherServices->count() > 0)
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <h3 class="text-2xl font-bold mb-6">{{ __('messages.other_services') }}</h3>
                    <div class="space-y-4">
                        @foreach($otherServices as $other)
                        <a href="{{ route('services.show', $other->slug) }}" class="block p-4 rounded-lg hover:bg-gray-50 transition-all duration-300 border border-transparent hover:border-gray-200">
                            <h4 class="font-semibold text-gray-900 mb-1">{{ app()->getLocale() == 'ar' ? $other->title : $other->title_en ?? $other->title }}</h4>
                            <p class="text-sm text-gray-600">{{ app()->getLocale() == 'ar' ? Str::limit($other->description, 80) : Str::limit($other->description_en ?? $other->description, 80) }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@endsection
