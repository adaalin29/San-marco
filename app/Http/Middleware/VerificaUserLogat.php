<?php

namespace App\Http\Middleware;

use Closure;
use App\Conturi;
class VerificaUserLogat
{
    public function handle($request, Closure $next)
    {
        $userLogat = false;
        if ($userid = session('userid')) {
            $user = Conturi::find($userid);
            if($user){
                session(['userid' => $userid]);
                $userLogat = true;
            }
        }
        if(!$userLogat){
            session(['userid' => null]);
            return redirect('/#login');
        }
        return $next($request);
    }
}