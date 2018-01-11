<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeMealItems extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'freemeal_items';

	/**
	 * Fields that can be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = [
		'order_id',
		'food_id',
		'merchant_id',
		'nama_makanan',
		'price',
		'waktu_kirim',
		'merchant_owner',
		'merchant_name',
		'merchant_address',
		'merchant_phone',
	];
}
