<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
	use CrudTrait;

	protected $table = 'review';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		// 'merchant_id',
		'user_id',
		'invoice',
		'rating',
		'comment',
		'type',
	];
	// protected $hidden = [];
	// protected $dates = [];

	/**
	 * Review belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

}
