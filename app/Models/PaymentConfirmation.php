<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model {
	use CrudTrait;

	/**
	 * Fields that can be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'order_id', 'status', 'image', 'payment_type'];

	public function setImageAttribute($value) {
		if (!is_null($value)) {
			$lokasi = 'payments';
			$filename = 'payment-' . time() . mt_rand(1111, 9999) . '.jpg';
			$decode_gambar = base64_decode($value);
			file_put_contents($lokasi . '/' . $filename, $decode_gambar);

			$this->attributes['image'] = $lokasi . '/' . $filename;
		} else {
			$this->attributes['image'] = 'cash';
		}

	}

	public function scopeStatus($query, $value) {
		return $query->where('status', $value);
	}
}
