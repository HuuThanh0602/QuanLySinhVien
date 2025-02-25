<?php
namespace App\Http\Middleware ;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập trước!');
        }
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập!');
        }

        return $next($request);
    }
}
