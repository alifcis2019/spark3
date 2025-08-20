<?php
// app/Http/Controllers/ServiceController.php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->orderBy('sort_order')->paginate(12);
        return view('services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Get related services
        $relatedServices = Service::active()
            ->where('id', '!=', $service->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
