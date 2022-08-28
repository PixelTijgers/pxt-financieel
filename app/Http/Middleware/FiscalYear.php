<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class FiscalYear
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('fiscal_year')) {
            session()->get('fiscal_year');
        }
        else { // This is optional as Laravel will automatically set the fallback season if there is none specified
            session()->put('fiscal_year', date('Y'));
        }
        return $next($request);
    }
}
