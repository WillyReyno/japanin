<?php namespace App\Http\Middleware;

use App\Models\Event;
use App\Models\Oldslug as Os;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class Oldslug {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        $routeSlug = $request->route()->event;

        // On check si ce slug existe dans la liste des anciens slugs
        $oldSlug = Os::whereSlug($routeSlug)->first();

        // Si l'ancien slug existe bien
        if (!is_null($oldSlug)) {

            // On récupère l'évènement valide qui co rrespond à cet ancien slug
            $eventnew = Event::find($oldSlug->event_id);

            // Si l'ancien slug et le nouveau sont bien les même, on redirige vers le nouveau
            if($routeSlug == $oldSlug->slug) {
                return redirect('event/'.$eventnew->slug, 301);
                //return redirect('event/'.$eventnew->slug, 301);
            }
        } else {
            return $next($request);
        }
    }
}


