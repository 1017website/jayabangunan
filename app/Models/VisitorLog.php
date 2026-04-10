<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VisitorLog extends Model
{
    protected $fillable = ['ip_address', 'user_agent', 'page', 'referer', 'visited_at'];

    protected $casts = ['visited_at' => 'date'];

    // Catat pengunjung baru
    public static function record(Request $request): void
    {
        $ip   = $request->ip();
        $page = $request->path();
        $today = now()->toDateString();

        // Hitung 1x per IP per hari per halaman (hindari duplikat)
        $exists = static::where('ip_address', $ip)
            ->where('page', $page)
            ->where('visited_at', $today)
            ->exists();

        if (!$exists) {
            static::create([
                'ip_address' => $ip,
                'user_agent' => substr($request->userAgent() ?? '', 0, 255),
                'page'       => '/' . $page,
                'referer'    => substr($request->header('referer') ?? '', 0, 255),
                'visited_at' => $today,
            ]);
        }
    }

    // Total semua pengunjung unik (by IP)
    public static function totalUnique(): int
    {
        return static::distinct('ip_address')->count('ip_address');
    }

    // Total kunjungan (semua record)
    public static function totalVisits(): int
    {
        return static::count();
    }

    // Pengunjung hari ini
    public static function todayCount(): int
    {
        return static::where('visited_at', now()->toDateString())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    // Pengunjung 7 hari terakhir (untuk chart)
    public static function last7Days(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date  = now()->subDays($i)->toDateString();
            $label = now()->subDays($i)->translatedFormat('D, d M');
            $count = static::where('visited_at', $date)
                ->distinct('ip_address')
                ->count('ip_address');
            $data[] = ['date' => $date, 'label' => $label, 'count' => $count];
        }
        return $data;
    }

    // Pengunjung 30 hari terakhir
    public static function last30Days(): int
    {
        return static::where('visited_at', '>=', now()->subDays(30)->toDateString())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    // Halaman terpopuler
    public static function topPages(int $limit = 5): \Illuminate\Support\Collection
    {
        return static::selectRaw('page, COUNT(*) as visits')
            ->groupBy('page')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }
}
