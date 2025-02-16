<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheekUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$type)
    {
        $user=$request->user();
        if(!$user){
            return redirect()->route('login');
        }
//        if($user->type!=$type){
//            abort(403);
//        }
        if(! in_array($user->type,$type)){
            abort(403);
        }

        return $next($request);
    }
}
