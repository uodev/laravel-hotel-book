<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //kullanici giris yapmissa login sayfasina gitmesini engelle
        if (session()->has('hotel')) {
            return redirect()->route('hotel.index');
        }




        return $next($request);
    }
}
