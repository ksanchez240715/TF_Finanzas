<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyRole
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $roles)
    {
        try
        {
            if($this->auth->guest() || !$request->user()->hasRole(explode('|',$roles)))
            {
                $request->session()->flush();
                return abort(404);
//                alert()->warning("Por favor inicie sesion para ingresar.","¡ Advertencia !");
//                return redirect("/");
            }
            return $next($request);
        }
        catch (\Exception $e)
        {
            return redirect("/");
        }

    }
}
