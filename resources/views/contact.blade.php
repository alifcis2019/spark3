{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', __('messages.contact_us') . ' - ' . \App\Models\SiteSetting::get('company_name', 'Spark'))
@section('meta_description', __('messages.contact_us_meta_description'))

@section('content')

<!-- Page Header -->
<section class="bg-brand-gradient text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 hero-pattern opacity-10"></div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in">{{ __('messages.contact_us') }}</h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto animate-slide-up" style="animation-delay: 0.2s;">
            {{ __('messages.contact_us_subtitle') }}
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Contact Form -->
            <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-lg">
                <h2 class="text-3xl font-bold mb-6">{{ __('messages.send_us_a_message') }}</h2>

                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6" role="alert">
                    <p class="font-bold">{{ __('messages.success') }}</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="gap-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.name') }} *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
                            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email') }} *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
                            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.subject') }} *</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
                        @error('subject')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.message') }} *</label>
                        <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full bg-brand-gradient text-white py-4 rounded-lg font-semibold text-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        {{ __('messages.send_message') }}
                    </button>
                </form>
            </div>

            <!-- Contact Info Sidebar -->
            <aside class="space-y-8">
                @if($phone = \App\Models\SiteSetting::get('phone'))
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-start gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-phone text-primary text-xl"></i></div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.phone') }}</h4>
                        <p class="text-gray-600" dir="ltr">{{ $phone }}</p>
                    </div>
                </div>
                @endif
                @if($email = \App\Models\SiteSetting::get('email'))
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-start gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-envelope text-green-600 text-xl"></i></div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.email') }}</h4>
                        <p class="text-gray-600">{{ $email }}</p>
                    </div>
                </div>
                @endif
                @if($address = \App\Models\SiteSetting::get('address'))
                <div class="bg-white p-6 rounded-2xl shadow-lg flex items-start gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-map-marker-alt text-purple-600 text-xl"></i></div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ __('messages.address') }}</h4>
                        <p class="text-gray-600">{{ $address }}</p>
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="bg-gray-50 pb-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.our_location') }}</h2>
            <p class="text-gray-600">{{ __('messages.visit_us') }}</p>
        </div>
        <div class="bg-gray-200 h-96 rounded-2xl overflow-hidden shadow-lg">
            {{-- To embed your map: 1. Go to Google Maps. 2. Find your location. 3. Click "Share". 4. Click "Embed a map". 5. Copy the HTML and paste the src URL here. --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.736554338243!2d31.23344931511519!3d30.04441998188239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145840c75022c107%3A0x8474f63633e1a7d!2sTahrir%20Square!5e0!3m2!1sen!2seg!4v1620045678901!5m2!1sen!2seg"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>
@endsection
