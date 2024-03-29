<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract, SluggableInterface {

	use Authenticatable, CanResetPassword, HasRoleAndPermission, SluggableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'username', 'email', 'password', 'birth', 'sex', 'avatar', 'provider', 'provider_id'];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $guarded = ['id'];

	protected $sluggable = array(
		'build_from' => 'username',
		'save_to' => 'slug',
		'on_update' => 'true'
	);

    public function events() {

        return $this->belongsToMany('App\Models\Event', 'user_events', 'user_id', 'event_id')->withTimestamps();

    }

}
