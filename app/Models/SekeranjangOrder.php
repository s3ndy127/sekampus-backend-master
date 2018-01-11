<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SekeranjangOrder extends Model {
	use CrudTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sekeranjang_order';

	/**
	 * Fields that can be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'item_id',
		'merchant_id',
		'invoice',
		'nama_penerima',
		'telepon_penerima',
		'catatan_penerima',
		'alamat_penerima',
		'catatan_lokasi',
		'tanggal_kirim',
		'latitude',
		'longitude',
		'waktu_cod',
		'tipe_pembayaran',
		'price',
		'nama_item',
		'invoice_type',
		'service_type',
		'merchant_owner',
		'merchant_address',
		'merchant_phone',
		'is_reviewed',
	];

	/**
	 * SekeranjangOrder belongs to Users.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function users() {
		// belongsTo(RelatedModel, foreignKey = users_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	/**
	 * SekeranjangOrder belongs to Item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function item() {
		// belongsTo(RelatedModel, foreignKey = item_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\Models\Sekeranjang', 'item_id', 'id');
	}

	/**
	 * SekeranjangOrder belongs to Merchant.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function merchant() {
		// belongsTo(RelatedModel, foreignKey = merchant_id, keyOnRelatedModel = id)
		return $this->belongsTo('App\Models\Merchant', 'merchant_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function payment() {
		// hasOne(RelatedModel, foreignKeyOnRelatedModel = freemeal_id, localKey = id)
		return $this->hasOne('App\Models\PaymentConfirmation', 'order_id', 'invoice');
	}
}
