{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.app')

@section('title', 'المدونة - أدوات الأمان')
@section('meta_description', 'تابع آخر المقالات والأخبار في مجال السلامة والأمان')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-900 to-purple-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">المدونة</h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                تابع آخر المقالات والنصائح المتخصصة في مجال السلامة والأمان
            </p>
        </div>
    </div>
</section>

<!-- Blog Posts -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-newspaper text-white text-4xl"></i>
                </div>
                @endif

                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-3">
                        {{ $post->published_at->format('d M Y') }}
                    </div>
                    <h2 class="text-xl font-bold mb-3 leading-tight">
                        <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-safety-orange transition-colors">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center text-safety-orange font-semibold hover:text-orange-600 transition-colors">
                        اقرأ المزيد
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-newspaper text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-600 mb-2">لا توجد مقالات متاحة حالياً</h3>
            <p class="text-gray-500">سيتم إضافة المقالات قريباً</p>
        </div>
        @endif
    </div>
</section>
@endsection