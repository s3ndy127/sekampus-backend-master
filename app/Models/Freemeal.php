<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Freemeal extends Model {
	use CrudTrait;

	protected $table = 'freemeal_order';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'user_id',
		// 'merchant_id',
		'invoice',
		'campus_id',
		'nama_penerima',
		'telepon_penerima',
		'alamat_penerima',
		'catatan_penerima',
		'latitude',
		'longitude',
		'tanggal_kirim',
		'price',
		'nama_kampus',
		'catatan_makanan',
		'is_reviewed',
	];
	// protected $hidden = [];
	// protected $dates = [];

	/**
	 * Freemeal belongs to User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	/**
	 * Freemeal has many Items.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items() {
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = freemeal_id, localKey = id)
		return $this->hasMany('App\Models\FreeMealItems', 'order_id', 'id');
	}

	/**
	 * Freemeal has one Payment.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function payment() {
		// hasOne(RelatedModel, foreignKeyOnRelatedModel = freemeal_id, localKey = id)
		return $this->hasOne('App\Models\PaymentConfirmation', 'order_id', 'invoice');
	}

}
