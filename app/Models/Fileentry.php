<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model {

    protected $table = 'fileentries';

    protected $fillable = ['filname', 'mime', 'original_filename'];

    protected $hidden = [];

}
