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

class PandoraUserController extends Controller {

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

        /*$all_users = User::count();
        $usersperpage = 20;

        if($all_users < $usersperpage)
            $usersperpage = null;

        $users = User::paginate($usersperpage);*/

        $users = User::all();

        $facebook = User::where('provider', 'facebook')->count();
        $twitter = User::where('provider', 'twitter')->count();
        $google = User::where('provider', 'google')->count();
        $japanin = User::where('provider', 'japanin')->count();

        return view('pandora.users.index', compact('users', 'facebook', 'twitter', 'google', 'japanin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pandora.users.edit', compact('user'));
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

                return Redirect::route('user.edit', $user->id)->withInput($input)->withErrors($validator->getMessageBag());

            } else {
                $user->username = $input['username'];
                $user->email = $input['email'];
                if(!$user->provider && !empty($input['password'])){
                    $user->password = bcrypt($input['password']);
                }
                $user->birth = $input['birth'];
                $user->sex = $input['sex'];

                $user->save();

                return Redirect::route('admin.user.edit', $user)
                    ->with('message', 'Utilisateur modifié')
                    ->with('color', 'success');
            }
        }

        return Redirect::route('user.index')
            ->with('message', 'Vous n\'avez pas les permissions requises')
            ->with('color', 'warning');

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

        $user->delete();

        return Redirect::back()
            ->with('message', 'Utilisateur supprimé')
            ->with('color', 'danger');

    }

}
