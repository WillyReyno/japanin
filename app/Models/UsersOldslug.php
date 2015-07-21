<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersOldslug extends Model {

    protected $table = 'users_oldslugs';

    protected $fillable = ['user_id', 'slug'];

    protected $hidden = [];

}