<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Catering extends Model {
	use CrudTrait;

	protected $table = 'catering';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = [];
	protected $fillable = [
		'merchant_id',
		'name',
		'price',
		'amount',
	];
	protected $hidden = ['created_at', 'updated_at'];
	// protected $dates = [];

	/**
	 * Catering belongs to Merchant.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function merchant() {
		// belongsTo(RelatedModel, foreignKey = merchant_id, keyOnRelatedModel = id)
		return $this->belongsTo(Merchant::class);
	}

	/**
	 * Catering has many Menu.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function menu() {
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = catering_id, localKey = id)
		return $this->hasMany('App\Models\Menu', 'catering_id', 'id');
	}
}
