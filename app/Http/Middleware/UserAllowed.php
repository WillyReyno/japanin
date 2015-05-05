<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAllowed {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $event = $request->event;
        $user = Auth::user();

        if(($user->id == $event->user_id) OR $user->isAdmin()) {
            return $next($request);
        } else {
            // Todo Customiser la réponse et / ou faire une redirection
            return response('Unauthorized.', 401);
        }
    }

}
