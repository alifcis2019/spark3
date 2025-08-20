{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('messages.main_title') . ' - ' . \App\Models\SiteSetting::get('company_name', 'Spark'))</title>
    <meta name="description" content="@yield('meta_description', __('messages.main_subtitle'))">

    <!-- Styles & Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles' )
</head>

<body class="bg-gray-50 text-gray-900 {{ app()->getLocale() == 'ar' ? 'font-arabic' : 'font-english' }}">
    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-primary"></div>
    </div>

    <!-- Top Bar -->
    <div class="bg-gray-800 text-white py-2 text-sm no-print">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    @if($phone = \App\Models\SiteSetting::get('phone'))
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-phone {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        <span>{{ $phone }}</span>
                    </div>
                    @endif
                    @if($email = \App\Models\SiteSetting::get('email'))
                    <div class="flex items-center text-gray-300">
                        <i class="fas fa-envelope {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        <span>{{ $email }}</span>
                    </div>
                    @endif
                </div>

                <div class="flex items-center gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <!-- Language Switcher -->
                    <div class="flex items-center gap-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <a href="{{ route('lang.switch', 'ar') }}" class="hover:text-primary transition-colors {{ app()->getLocale() == 'ar' ? 'text-primary font-semibold' : 'text-gray-300' }}">العربية</a>
                        <span class="text-gray-500">|</span>
                        <a href="{{ route('lang.switch', 'en') }}" class="hover:text-primary transition-colors {{ app()->getLocale() == 'en' ? 'text-primary font-semibold' : 'text-gray-300' }}">English</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-40 no-print">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    @php $logo = \App\Models\SiteSetting::get('logo'); @endphp
                    @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="{{ \App\Models\SiteSetting::get('company_name', 'Spark') }}" class="h-16 w-16 w-auto">
                    @else
                    <div class="bg-primary text-white px-4 py-2 rounded-lg font-bold text-xl">
                        <i class="fas fa-bolt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ \App\Models\SiteSetting::get('company_name', 'Spark') }}
                    </div>
                    @endif
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.home') }}</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">{{ __('messages.about') }}</a>
                    <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">{{ __('messages.services') }}</a>
                    <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">{{ __('messages.blog') }}</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('messages.contact') }}</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="{{ route('contact') }}" class="bg-brand-gradient text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        {{ __('messages.free_consultation') }}
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-bars text-xl text-gray-700"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white border-t">
                <div class="py-4 space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-3 hover:bg-gray-50 text-gray-700">{{ __('messages.home') }}</a>
                    <a href="{{ route('about') }}" class="block px-4 py-3 hover:bg-gray-50 text-gray-700">{{ __('messages.about') }}</a>
                    <a href="{{ route('services.index') }}" class="block px-4 py-3 hover:bg-gray-50 text-gray-700">{{ __('messages.services') }}</a>
                    <a href="{{ route('blog.index') }}" class="block px-4 py-3 hover:bg-gray-50 text-gray-700">{{ __('messages.blog') }}</a>
                    <a href="{{ route('contact') }}" class="block px-4 py-3 hover:bg-gray-50 text-gray-700">{{ __('messages.contact') }}</a>
                    <div class="px-4 pt-4">
                        <a href="{{ route('contact') }}" class="block w-full bg-brand-gradient text-white text-center px-4 py-3 rounded-lg font-semibold">
                            {{ __('messages.free_consultation') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white no-print">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Company Info -->
                <div class="space-y-4 col-span-1 md:col-span-2 lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center">
                        @if($logo)
                        <img src="{{ Storage::url($logo) }}" alt="{{ \App\Models\SiteSetting::get('company_name', 'Spark') }}" class="h-16 w-16 rounded-full">
                        @else
                        <div class="bg-primary text-white px-3 py-2 rounded-lg font-bold">
                            <i class="fas fa-bolt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ \App\Models\SiteSetting::get('company_name', 'Spark') }}
                        </div>
                        @endif
                    </a>
                    <p class="text-gray-400 leading-relaxed">
                        {{ \App\Models\SiteSetting::get('company_description', __('messages.main_subtitle')) }}
                    </p>
                    <div class="flex gap-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        @if($facebook = \App\Models\SiteSetting::get('facebook_url'))
                        <a href="{{ $facebook }}" class="text-gray-400 hover:text-primary transition-colors"><i class="fab fa-facebook-f text-xl"></i></a>
                        @endif
                        @if($twitter = \App\Models\SiteSetting::get('twitter_url'))
                        <a href="{{ $twitter }}" class="text-gray-400 hover:text-primary transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                        @endif
                        @if($linkedin = \App\Models\SiteSetting::get('linkedin_url'))
                        <a href="{{ $linkedin }}" class="text-gray-400 hover:text-primary transition-colors"><i class="fab fa-linkedin-in text-xl"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.quick_links') }}</h3>
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" class="block text-gray-300 hover:text-white transition-colors">{{ __('messages.home') }}</a>
                        <a href="{{ route('about') }}" class="block text-gray-300 hover:text-white transition-colors">{{ __('messages.about') }}</a>
                        <a href="{{ route('services.index') }}" class="block text-gray-300 hover:text-white transition-colors">{{ __('messages.services') }}</a>
                        <a href="{{ route('blog.index') }}" class="block text-gray-300 hover:text-white transition-colors">{{ __('messages.blog') }}</a>
                        <a href="{{ route('contact') }}" class="block text-gray-300 hover:text-white transition-colors">{{ __('messages.contact') }}</a>
                    </div>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.our_services') }}</h3>
                    <div class="space-y-3">
                        @php $footerServices = \App\Models\Service::active()->take(5)->get(); @endphp
                        @foreach($footerServices as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="block text-gray-300 hover:text-white transition-colors">
                            {{ app()->getLocale() == 'ar' ? $service->title : $service->title_en ?? $service->title }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.contact_info') }}</h3>
                    <div class="space-y-4">
                        @if($phone = \App\Models\SiteSetting::get('phone'))
                        <div class="flex items-center">
                            <i class="fas fa-phone text-primary {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-5 text-center"></i>
                            <span class="text-gray-300">{{ $phone }}</span>
                        </div>
                        @endif
                        @if($email = \App\Models\SiteSetting::get('email'))
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-primary {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }} w-5 text-center"></i>
                            <span class="text-gray-300">{{ $email }}</span>
                        </div>
                        @endif
                        @if($address = \App\Models\SiteSetting::get('address'))
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary {{ app()->getLocale() == 'ar' ? 'ml-3 mt-1' : 'mr-3 mt-1' }} w-5 text-center"></i>
                            <span class="text-gray-300">{{ $address }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-6 text-center">
                <p class="text-gray-400">
                    © {{ date('Y') }} {{ \App\Models\SiteSetting::get('company_name', 'Spark') }}. {{ __('messages.all_rights_reserved') }}
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 {{ app()->getLocale() == 'ar' ? 'left-8' : 'right-8' }} bg-primary text-white p-3 rounded-full shadow-lg opacity-0 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1 no-print">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <script>
        window.addEventListener('load', () => document.getElementById('loading-screen').style.display = 'none');
        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            backToTopButton.style.opacity = (window.pageYOffset > 300) ? '1' : '0';
        });
        backToTopButton.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));
    </script>
    @stack('scripts')

    <style>
        .nav-link.active {
            color: var(--primary) !important;
        }

        * {
            transition: all 0.3s ease-in-out !important;
        }
    </style>
</body>

</html>
