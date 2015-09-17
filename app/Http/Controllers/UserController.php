<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Event;
use App\Models\UserEvent;
use \Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use \Input;
use Illuminate\Http\Request;
use \Redirect;
use Validator;

class UserController extends Controller {

	public function __construct()
	{
		// Middleware permettant d'effectuer les redirections 301
		$this->middleware('auth', ['only' => ['edit', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		$events_created = Event::where('user_id', $user->id)->get();

		//TODO Récupérer les events auxquels on a participé
		//$events_gone = UserEvent::where('user_id', $user->id)->lists('name');
		return view('users.show', compact('user', 'events_created', 'events_gone'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		if(Auth::check() && (Auth::user()->isAdmin() OR Auth::user()->id === $user->id)) {
			$input = Input::all();

			if(!$user->provider) {
				if (trim($input['password']) != '') {
					$rules =  [
						'username' => 'max:255',
						'email' => 'email|max:255|unique:users,email,'.$user->id,
						'password' => 'confirmed|min:6',
						'birth' => 'date',
					];
				}
			} else {
				$rules =  [
					'username' => 'max:255',
					'email' => 'email|max:255|unique:users,email,'.$user->id,
					'birth' => 'date',
				];
			}

			$validator = Validator::make($input, $rules);

			if ($validator->fails()) {

				return Redirect::route('user.edit', $user->slug)->withInput($input)->withErrors($validator->getMessageBag());

			} else {

				$user->username = $input['username'];
				$user->email = $input['email'];
				if(!$user->provider && !empty($input['password'])){
					$user->password = bcrypt($input['password']);
				}
				$user->birth = $input['birth'];
				$user->sex = $input['sex'];

				$user->save();

				return Redirect::route('user.show', [$user->id])->with('message', 'Utilisateur modifié');
			}



		}

		return Redirect::route('user.index')->with('message', 'Vous n\'avez pas les permissions requises');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if(Auth::check() && (Auth::user()->isAdmin() OR Auth::user()->id === $user->id)) {

			$user->delete();

			return Redirect::route('user.index')->with('message', 'Membre supprimé');

		} else {
			return Redirect::route('user.index')->with('message', 'Vous n\'avez pas les permissions requises');
		}

	}

}
