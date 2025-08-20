{{-- resources/views/blog/show.blade.php --}}
@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title . ' - أدوات الأمان')
@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('content')
<!-- Post Header -->
<section class="bg-white py-12 border-b">
    <div class="container mx-auto px-4">
        <nav class="text-sm mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-safety-orange">الرئيسية</a>
            <span class="mx-2">/</span>
            <a href="{{ route('blog.index') }}" class="text-gray-500 hover:text-safety-orange">المدونة</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $post->title }}</span>
        </nav>

        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
            <div class="text-gray-500 mb-8">
                <time datetime="{{ $post->published_at->toISOString() }}">
                    {{ $post->published_at->format('d F Y') }}
                </time>
            </div>

            @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full max-w-2xl mx-auto rounded-2xl shadow-lg">
            @endif
        </div>
    </div>
</section>

<!-- Post Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="prose prose-lg max-w-none">
                    {!! $post->content !!}
                </div>

                <!-- Share Buttons -->
                <div class="mt-12 pt-8 border-t">
                    <h3 class="text-lg font-semibold mb-4">شارك المقال</h3>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="bg-blue-400 text-white p-3 rounded-lg hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="bg-green-500 text-white p-3 rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Contact Card -->
                <div class="bg-gradient-to-br from-safety-orange to-yellow-500 text-white p-6 rounded-2xl">
                    <h3 class="text-xl font-bold mb-3">هل تحتاج مساعدة؟</h3>
                    <p class="mb-4">تواصل معنا للحصول على استشارة مجانية</p>
                    <a href="{{ route('contact') }}" class="block w-full bg-white text-gray-900 text-center py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                        تواصل معنا
                    </a>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div class="bg-gray-50 p-6 rounded-2xl">
                    <h3 class="text-xl font-bold mb-4">مقالات ذات صلة</h3>
                    <div class="space-y-4">
                        @foreach($relatedPosts as $related)
                        <a href="{{ route('blog.show', $related->slug) }}" class="block group">
                            <div class="flex space-x-4 space-x-reverse">
                                @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" class="w-16 h-16 object-cover rounded-lg">
                                @else
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-lg"></i>
                                </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-safety-orange transition-colors leading-tight">
                                        {{ $related->title }}
                                    </h4>
                                    <div class="text-sm text-gray-500 mt-1">
                                        {{ $related->published_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection