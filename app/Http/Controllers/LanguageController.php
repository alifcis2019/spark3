<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Validate locale
        if (in_array($locale, ['ar', 'en'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
