<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Hanya track halaman frontend (bukan admin, bukan asset)
        $path = $request->path();
        $skip = [
            'admin',
            'api',
            '_ignition',
            'livewire',
            'favicon.ico',
            'storage',
        ];

        $shouldSkip = collect($skip)->contains(fn($s) => str_starts_with($path, $s));

        if (!$shouldSkip && $request->isMethod('GET') && $response->getStatusCode() === 200) {
            try {
                VisitorLog::record($request);
            } catch (\Exception $e) {
                // Silent fail - jangan sampai error tracking mengganggu website
            }
        }

        return $response;
    }
}
