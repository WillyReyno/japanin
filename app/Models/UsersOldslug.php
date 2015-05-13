<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersOldslug extends Model {

    protected $table = 'oldslugs';

    protected $fillable = ['user_id', 'slug'];

    protected $hidden = [];

}