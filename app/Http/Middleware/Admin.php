<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \Redirect;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $user = Auth::user();

        if($user->isAdmin()) {
            return $next($request);
        } else {
            // Todo Customiser la réponse et / ou faire une redirection
            return Redirect::back();
        }
	}

}
