<?php

namespace App\Http\Middleware;

use Closure;

class Salesman
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
        if (\Auth::user()->role_id != '2') {
            $request->session()->flash('message', 'You are not authorized!.');
            $request->session()->flash('alert-class', 'alert-danger');
            switch (\Auth::user()->role_id) {
                 case '8':
                    return '/clientMaster/home';
                    break;
                case '7':
                    return redirect('/usuarioValidacion');
                    break;
                case '5':
                    return redirect('/usuarioPesca');
                    break;
                case '6':
                    return redirect('/usuarioIntermediario');
                    break;
                case '4':
                    return redirect('/admin');
                    break;
                case '3':
                    return redirect('/promoter');
                    break;
                case '1':
                    return redirect('/client/home');
                    break;
                default:
                    return redirect('/');
                    break;
            }
        }
        return $next($request);
    }
}
