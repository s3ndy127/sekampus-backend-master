<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
	use Notifiable, CrudTrait, HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'phone', 'fcm_token',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function getJWTIdentifier() {
		return $this->getKey();
	}

	public function getJWTCustomClaims() {
		return [];
	}

	/**
	 * User has one Merchant.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function merchant() {
		// hasOne(RelatedModel, foreignKeyOnRelatedModel = user_id, localKey = id)
		return $this->hasOne('App\Models\Merchant', 'user_id', 'id');
	}

	public function events() {
		return $this->belongsToMany('App\Models\Events', 'event_comments', 'user_id', 'komunitas_id')
			->withPivot('comment')
			->withTimeStamps();
	}
}
