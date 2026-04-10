<?php

namespace App\Http\Controllers;

use App\Models\{Setting, Service, Project, Testimonial, Stat, ContactMessage};
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $hero        = Setting::getGroup('hero');
        $about       = Setting::getGroup('about');
        $company     = Setting::getGroup('company');
        $services    = Service::active()->get();
        $projects    = Project::active()->get();
        $stats       = Stat::active()->get();
        $testimonials= Testimonial::active()->get();

        return view('frontend.home', compact(
            'hero','about','company','services','projects','stats','testimonials'
        ));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|max:20',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Pesan Anda telah terkirim! Tim kami akan segera menghubungi Anda.');
    }
}
