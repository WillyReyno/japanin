<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\UsersOldslug;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class UserController extends Controller {

    public function __construct()
    {
        // Middleware permettant d'effectuer les redirections 301
        $this->middleware('usersoldslug', ['only' => ['show', 'edit']]);
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
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(User $user)
    {

        /*
             * 1) Check if user can edit
             * 2) Get all the fields and check if they've been altered
             * 3) Create rules and check theme
             * 4) if fail -> display error on form
             * 5) if ok -> update user and redirect
             *
             */
        if(Auth::check() && (Auth::user()->isAdmin() OR Auth::user()->id === $user->id)) {
            $input = Input::all();

            if (trim($input['password']) != '') {
                $rules =  [
                    'username' => 'max:255',
                    'email' => 'email|max:255|unique:users,email,'.$user->id,
                    'password' => 'confirmed|min:6',
                    'birth' => 'date',
                ];
            } else {
                $rules =  [
                    'username' => 'max:255',
                    'email' => 'email|max:255|unique:users,email,'.$user->id,
                    'birth' => 'date',
                ];
            }


            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return Redirect::action('UserController@edit', array($user->getSlug()))->withInput($input)->withErrors($validator->getMessageBag());
            } else {
                /* Saving old slug for 301 redirections */
                if ($input['username'] != $user->username) {

                    $oldslug = UsersOldslug::create([
                        'user_id' => $user->id,
                        'slug' => $user->slug
                    ]);

                    $oldslug->save();

                }

                $user->username = $input['username'];
                $user->email = $input['email'];
                $user->password = bcrypt($input['password']);
                $user->birth = $input['birth'];
                $user->sex = $input['sex'];
                //$user->avatar = $input['avatar'];
                $user->save();
                return Redirect::route('user.show', [$user->slug])->with('message', 'Utilisateur modifié');
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
        //
    }

}
