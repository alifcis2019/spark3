<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'company' => 'nullable|string|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:2000',
            ], [
                'name.required' => 'الاسم مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
                'subject.required' => 'الموضوع مطلوب',
                'message.required' => 'الرسالة مطلوبة',
            ]);

            ContactMessage::create($validated);

            return back()->with('success', 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.');
        }
    }
}
