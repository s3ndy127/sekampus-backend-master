<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Sekeranjang extends Model {
	use CrudTrait;

	protected $table = 'sekeranjang';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'merchant_id',
		'nama_barang',
		'kategori',
		'price',
		'image',
		'kondisi',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
	];
	// protected $dates = [];

	/**
	 * Sekeranjang belongs to Merchant.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function merchant() {
		// belongsTo(RelatedModel, foreignKey = merchant_id, keyOnRelatedModel = id)
		return $this->belongsTo(Merchant::class);
	}

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/sekeranjang";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}
}
