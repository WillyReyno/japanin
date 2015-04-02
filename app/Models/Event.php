<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;


class Event extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $table = 'events';

    protected $fillable = [
        'name', 'type_id', 'address', 'latitude', 'longitude',
        'start_date', 'end_date', 'description', 'poster', 'user_id', 'private'];

    protected $hidden = [];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
    );
}
