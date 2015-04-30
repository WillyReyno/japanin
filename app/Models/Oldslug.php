<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oldslug extends Model {

    protected $table = 'oldslugs';

    protected $fillable = ['event_id', 'slug'];

    protected $hidden = [];

}
