<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Stat;
use App\Models\ContactMessage;
use App\Models\AboutHighlight;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Setting::getGroup('hero');
        $about = Setting::getGroup('about');
        $company = Setting::getGroup('company');
        $social = Setting::getGroup('social');
        $seo = Setting::getGroup('seo');
        $services = Service::active()->get();
        $projects = Project::active()->get();
        $categories = Project::active()->distinct()->pluck('category');
        $stats = Stat::active()->get();
        $testimonials = Testimonial::active()->get();
        $highlights = AboutHighlight::active()->get();
        $videos = Video::active()->take(6)->get();

        return view('frontend.home', compact(
            'hero',
            'about',
            'company',
            'social',
            'seo',
            'services',
            'projects',
            'categories',
            'stats',
            'testimonials',
            'highlights'
        ));
    }

    public function projects(Request $request)
    {
        $company = Setting::getGroup('company');
        $seo = Setting::getGroup('seo');
        $categories = Project::active()->distinct()->pluck('category');
        $category = $request->get('kategori');

        $projectsQuery = Project::active();
        if ($category && $category !== 'semua') {
            $projectsQuery->where('category', $category);
        }
        $projects = $projectsQuery->get();

        return view('frontend.projects', compact('company', 'seo', 'projects', 'categories', 'category'));
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Pesan Anda telah terkirim! Tim kami akan menghubungi Anda segera.');
    }
}
