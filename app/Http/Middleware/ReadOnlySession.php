<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ReadOnlySession
{
    public function handle($request, Closure $next)
    {
        // Disable saving session data for the request lifecycle
        Session::save();

        return $next($request);
    }
}
