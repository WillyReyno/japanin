<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Fileentry;
use App\Models\Oldslug;
use App\Models\User;
use App\Models\Type;
use App\Models\UserEvent;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request as Rqst;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFile;

class EventController extends CommonController {

    protected $rules = [
        'name' => ['required'],
        'type_id' => ['required'],
        'address' => ['required'],
        'latitude' => ['required'],
        'longitude' => ['required'],
        'start_date' => ['required'],
        'end_date' => ['required', 'end_after:start_date'],
        'description' => ['required']
    ];

    public function __construct()
    {
        // Middleware définissant les pages où l'on ne peut accéder uniquement si l'on est connecté
        $this->middleware('auth', ['only' => ['create', 'edit', 'destroy']]);
        // Middleware permettant d'effectuer les redirections 301
        $this->middleware('oldslug', ['only' => ['show', 'edit']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = Type::lists('name', 'id');
        return view('events.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $input = Input::all();
        $input['user_id'] = Auth::user()->id;
        if(Rqst::file()) {
            $input['poster'] = $this->imageUpload('poster', true);
        }
        Event::create($input);

        return Redirect::route('event.index')->with('message', 'Évènement ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function show(Event $event)
    {
        $type = Type::find($event->type_id);
        $author = User::find($event->user_id);
        $went = $this->userWent(Auth::user(), $event);


        foreach($event->users as $tests) {
            //dd($tests);
            //$users = User::find($users->pivot->user_id);
        }

        return view('events.show', compact('event', 'type', 'author', 'went', 'tests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event)
    {
        $types = Type::lists('name', 'id');
        return view('events.edit', compact('event', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Event $event
     * @return Response
     */
    public function update(Event $event)
    {
        if(Auth::user()->allowed('edit.event', $event)) {
            // TODO check si ce n'est pas une bêtise de retirer le token ?
            $input = array_except(Input::all(), ['_token', '_method', '_wysihtml5_mode']);

            /* Saving old slug for 301 redirections */
            if ($input['name'] != $event->name) {
                $oldslug = Oldslug::create([
                    'event_id' => $event->id,
                    'slug' => $event->slug
                ]);
                $oldslug->save();
            }

            /* If a file is sent */
            if (Rqst::file()) {
                $input['poster'] = $this->imageUpload('poster', true);
            }
            $event->update($input);

            return Redirect::route('event.show', [$event->slug])->with('message', 'Évènement modifié');
        } else {
            return Redirect::route('event.index')->with('message', 'Vous n\'avez pas les permissions requises');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return Response
     */
    public function destroy(Event $event)
    {
        // On vérifie, au cas où, si l'utilisateur possède bien les droits de suppression de l'évènement.
        if(Auth::user()->allowed('delete.event', $event)) {

            $oldslugs = Oldslug::where('event_id', $event->id);

            $event->delete();

            $oldslugs->delete();

            return Redirect::route('event.index')->with('message', 'Évènement supprimé');
        } else {
            return Redirect::route('event.index')->with('message', 'Vous n\'avez pas les permissions requises');
        }

    }

    /**
     * Checks if a user is going or went to a specific event
     *
     * @param User $user
     */
    public function userWent(User $user, Event $event) {

        $went = UserEvent::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->get();

        if(!empty($went[0])){
            return true;
        }

        return false;
    }


    /**
     * Add/Remove user to the event
     *
     * @param Event $event
     * @param User $user
     */
    public function userGoing($event_id)
    {

        $user = Auth::user();
        $event = Event::find($event_id);

        // TODO currently checked twice in process, see if it can be improved
        $went = $this->userWent($user, $event);

        if($went){
            $event->users()->detach($user->id);
        } else {
            $event->users()->attach($user->id);
        }

        return Redirect::route('event.show', [$event->slug]);
    }

}
