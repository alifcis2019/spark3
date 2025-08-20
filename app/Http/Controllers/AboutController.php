<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $services = Service::active()->featured()->take(6)->get();
        return view('about', compact('services'));
    }
}
