<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = env('APP_ENV') === 'local' ? fake()->ipv4() : $request->ip();

        $today = Carbon::today()->toDateString();
        $oneHourAgo = Carbon::now()->subHour();

        $hasVisitedRecently = DB::table('visitors')
            ->where('ip_address', $ip)
            ->where('created_at', '>=', $oneHourAgo)
            ->exists();

        if (!$hasVisitedRecently) {
            DB::table('visitors')->insert([
                'ip_address' => $ip,
                'visit_date' => $today,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return $next($request);
    }
}
