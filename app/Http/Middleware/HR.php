<?php

namespace App\Http\Middleware;
use App\UserRole;
use Closure;

class HR
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
        $account = UserRole::where('user_id',auth()->user()->id)->get();
        $account = $account->pluck('role_id')->toArray();
   
       if(in_array(1,$account))
       {
        return $next($request);
       }
       else
       {
        return redirect('accountabilites');
       }
        
    }
}
