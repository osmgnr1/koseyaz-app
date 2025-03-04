<?php

namespace App\Http\Middleware;

use App\Models\CornerPost;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CornerPostUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, CornerPost $cornerpost): Response
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
