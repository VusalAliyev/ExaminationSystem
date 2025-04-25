<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        try {
            $formData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'message' => $validated['message'],
            ];

            Mail::send(new ContactFormSubmission($formData));

            return redirect()->route('contact')->with('success', 'Mesajınız uğurla göndərildi! Tezliklə sizinlə əlaqə saxlayacağıq.');
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());

            return redirect()->route('contact')->with('error', 'Mesaj göndərilərkən xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
        }
    }

    public function testEmail()
    {
        try {
            $formData = [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '+994123456789',
                'message' => 'This is a test email.',
            ];

            Mail::send(new ContactFormSubmission($formData));

            return 'Test email sent successfully!';
        } catch (\Exception $e) {
            Log::error('Test email failed: ' . $e->getMessage());
            return 'Failed to send test email: ' . $e->getMessage();
        }
    }
}
