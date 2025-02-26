<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
class LangMiddleware
{
    public function handle(Request $request, Closure $next):Response
    {
        $lang = Session::get('lang','en');
        App::setLocale($lang);
        return $next($request);
    }
}
