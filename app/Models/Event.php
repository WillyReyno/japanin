<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Event extends Model {

	protected $table = 'events';

    protected $fillable = [
        'name', 'type_id', 'address', 'latitude', 'longitude',
        'start_date', 'end_date', 'description', 'poster', 'user_id', 'private'];

    protected $hidden = [];
}
