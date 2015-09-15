<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Fileentry;
use App\Models\User;
use App\Models\Type;
use App\Models\UserEvent;
use Illuminate\Http\Response;
use App\Models\Event;
use Illuminate\Http\Request;
use \Auth;
use \File;
use \Storage;
use \Input;
use \Redirect;


class PandoraEventController extends CommonController {

    protected $rules = [
        'name' => ['required'],
        'type_slug' => ['required'],
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
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $all_events = Event::count();
        $eventsperpage = 20;
        if($all_events < $eventsperpage)
            $eventsperpage = $all_events / 2;

        $events = Event::paginate($eventsperpage);

        return view('pandora.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        /*$types = Type::lists('name', 'slug');
        return view('events.create', compact('types'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, $this->rules);
        $input = Input::all();
        $input['user_id'] = Auth::user()->id;
        if(Rqst::file()) {
            $input['poster'] = $this->imageUpload('poster', true);
        }
        Event::create($input);

        return Redirect::route('event.index')->with('message', 'Évènement ajouté');*/
    }

    /**
     * Display the specified resource.
     *
     * @param $typeslug
     * @param null $slug
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($typeslug, $slug = null, $id)
    {

        /*$event = Event::find($id)->where('type_slug', $typeslug)->first();
        $type = Type::findBySlug($typeslug);
        $author = User::find($event->user_id);
        if(Auth::check()) {
            $went = $this->userWent(Auth::user(), $event);
        } else {
            $went = false;
        }

        return view('events.show', compact('event', 'type', 'author', 'went'));*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $types = Type::lists('name', 'slug');
        return view('pandora.events.edit', compact('event', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $event = Event::find($id);
        if(Auth::user()->allowed('edit.event', $event)) {

            $input = $request->all();

            /* If a file is sent */
            if ($request->file()) {
                $input['poster'] = $this->imageUpload('poster', true);
            }

            $event->update($input);

            return Redirect::route('admin.event.edit', $event)
                ->with('message', 'Évènement modifié')
                ->with('color', 'success');

        } else {
            return Redirect::route('event.index')
                ->with('message', 'Vous n\'avez pas les permissions requises')
                ->with('color', 'warning');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        $event->delete();

        return Redirect::back()
            ->with('message', 'Évènement supprimé')
            ->with('color', 'danger');
    }
}
