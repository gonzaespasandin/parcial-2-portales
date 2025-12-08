<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyMercadoPagoCallback
{
    /**
     * Verificar si request tiene payment_id y status para que pueda acceder a la ruta sin estos datos
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->has('payment_id') || !$request->has('status')){
            return redirect()->route('home')
                ->with('feedback.message', 'Acceso no autorizado')
                ->with('feedback.type', 'danger');
        }
        
        return $next($request);
    }
}
