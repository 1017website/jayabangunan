<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'      => Project::count(),
            'services'      => Service::count(),
            'testimonials'  => Testimonial::count(),
            'unread_msgs'   => ContactMessage::unread()->count(),
            'total_msgs'    => ContactMessage::count(),
            'visitors_today'   => \App\Models\VisitorLog::todayCount(),
            'visitors_total'   => \App\Models\VisitorLog::totalUnique(),
            'visitors_30days'  => \App\Models\VisitorLog::last30Days(),
        ];
        $recent_messages = ContactMessage::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recent_messages'));
    }
}
