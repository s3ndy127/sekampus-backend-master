<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Cateringorder extends Model {
	use CrudTrait;

	protected $table = 'catering_order';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'user_id',
		'catering_id',
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
	// protected $hidden = [
	// 	'created_at',
	// 	'updated_at',
	// ];
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
	 * Catering has many Menu.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items() {
		// hasMany(RelatedModel, foreignKeyOnRelatedModel = catering_id, localKey = id)
		return $this->hasMany('App\Models\Menu', 'catering_id', 'catering_id');
	}

	public function catering() {
		return $this->belongsTo('App\Models\Catering', 'catering_id', 'id');
	}

	public function payment() {

		return $this->hasOne('App\Models\PaymentConfirmation', 'order_id', 'invoice');
	}

}
