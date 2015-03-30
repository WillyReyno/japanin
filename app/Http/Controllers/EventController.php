<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;
use Illuminate\Http\Request;
use Input;
use Redirect;

class EventController extends Controller {

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
        return view('events.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
        Event::create($input);

        return Redirect::route('events.index')->with('message', 'Évènement ajouté');
	}

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Response
     */
	public function show(Event $event)
	{
        return view('events.show', compact('events'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
	public function edit(Event $event)
	{
        return view('events.edit', compact('events'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Event $event
     * @return Response
     */
	public function update(Event $event)
	{
		//
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return Response
     */
	public function destroy(Event $event)
	{
		//
	}

}
