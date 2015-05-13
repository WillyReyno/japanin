<?php namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UsersOldslug as Uos;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class UsersOldslug {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $routeUserSlug = $request->route()->user;
        // On check si ce slug existe dans la liste des anciens slugs
        $userOldSlug = Uos::whereSlug($routeUserSlug)->first();

        // Si l'ancien slug existe bien
        if (!is_null($userOldSlug)) {

            // On récupère l'évènement valide qui correspond à cet ancien slug
            $usernew = User::find($userOldSlug->event_id);

            // Si l'ancien slug et le nouveau sont bien les même, on redirige vers le nouveau
            if($routeUserSlug == $userOldSlug->slug) {
                return redirect('user'.$usernew->slug, 301);
            }
        } else {
            return $next($request);
        }
    }
}


