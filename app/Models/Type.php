<?php namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Type extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $table = 'types';

    protected $fillable = ['name'];

    protected $hidden = [];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];
}
