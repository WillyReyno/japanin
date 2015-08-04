<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model implements SluggableInterface {

    use SluggableTrait, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'name', 'type_slug', 'address', 'latitude', 'longitude',
        'start_date', 'end_date', 'description', 'user_id', 'poster', 'private'];

    protected $hidden = [];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
        'on_update' => true,
        'unique' => true,
        'include_trashed' => true,
    );

    protected $dates = ['deleted_at'];

    public function users() {

        return $this->belongsToMany('App\Models\User', 'user_events', 'event_id', 'user_id')->withTimestamps();

    }
}
