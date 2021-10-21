<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserCreated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $today = Carbon::today();
        $user = Auth::user();
        $user_created = $user->created_at;
        if ($user_created->format('d-m-Y') < $today->subDays(3)->format('d-m-Y')){
            abort(403);
        }

        return $next($request);
    }
}
