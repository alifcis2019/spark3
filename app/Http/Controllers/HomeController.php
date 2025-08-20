<?php
// app/Http/Controllers/HomeController.php (Fixed)
namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Service;
use App\Models\BlogPost;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::active()->featured()->orderBy('sort_order')->take(6)->get();
        $recentPosts = BlogPost::published()->latest('published_at')->take(3)->get();

        return view('home', compact('featuredServices', 'recentPosts'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('page', compact('page'));
    }
}
