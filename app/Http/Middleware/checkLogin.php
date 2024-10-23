<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Session;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {   
        $user = Session::get('user');
        try {
            if($user){ 
                return $next($request);
            }else{
                return redirect('login');
            }  
        } catch (\Throwable $th) {
            return response()->json(['data' => [
                'status' => false,
                'message' => 'Lỗi !!!'
            ]]);
        }
        
        
    }
}
