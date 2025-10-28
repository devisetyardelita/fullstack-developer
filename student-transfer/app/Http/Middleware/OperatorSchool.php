<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OperatorSchool
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!auth()->check() || auth()->user()->role !== 'operator') {
        //     abort(403, 'Unauthorized');
        // }
    
        // if ($request->route('mutation')) {
        //     $mutation = $request->route('mutation'); // Ambil data mutasi dari route
        //     if ($mutation->origin_school_id !== auth()->user()->school_id) {
        //         abort(403, 'Unauthorized');
        //     }
        // }
        return $next($request);
    }
}
