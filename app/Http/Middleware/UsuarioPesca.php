<?php

namespace App\Http\Middleware;

use Closure;

class UsuarioPesca
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
        if (\Auth::user()->role_id != '5') {
            $request->session()->flash('message', 'No estas autorizado para entrar aqui');
            $request->session()->flash('alert-class', 'alert-danger');
            switch (\Auth::user()->role_id) {
                 case '8':
                    return '/clientMaster/home';
                    break;
                case '7':
                    return redirect('/usuarioValidacion');
                    break;
                case '4':
                    return redirect('/admin');
                    break;
                case '6':
                    return redirect('/usuarioIntermediario');
                    break;
                case '3':
                    return redirect('/promoter');
                    break;
                case '2':
                    return redirect('/salesman');
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
