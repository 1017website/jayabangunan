<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;

class VisitorController extends Controller
{
    public function index()
    {
        $total_unique  = VisitorLog::totalUnique();
        $total_visits  = VisitorLog::totalVisits();
        $today         = VisitorLog::todayCount();
        $last_30_days  = VisitorLog::last30Days();
        $chart_data    = VisitorLog::last7Days();
        $top_pages     = VisitorLog::topPages(8);

        // Per bulan - 6 bulan terakhir
        $monthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = VisitorLog::whereYear('visited_at', $month->year)
                ->whereMonth('visited_at', $month->month)
                ->distinct('ip_address')
                ->count('ip_address');
            $monthly[] = [
                'label' => $month->translatedFormat('M Y'),
                'count' => $count,
            ];
        }

        return view('admin.visitors.index', compact(
            'total_unique', 'total_visits', 'today',
            'last_30_days', 'chart_data', 'top_pages', 'monthly'
        ));
    }

    public function clear()
    {
        VisitorLog::truncate();
        return redirect()->route('admin.visitors.index')
            ->with('success', 'Data pengunjung berhasil direset.');
    }
}
