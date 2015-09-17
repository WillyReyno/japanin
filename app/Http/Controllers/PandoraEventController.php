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
            $eventsperpage = null;

        $events = Event::paginate($eventsperpage);

        return view('pandora.events.index', compact('events'));
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
