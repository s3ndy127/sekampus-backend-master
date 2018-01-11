<?php

namespace App\Models;

use App\Http\Traits\SupportTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Food extends Model {
	use CrudTrait, SupportTrait;

	protected $table = 'food';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'merchant_id',
		'name',
		'description',
		'price',
		'type',
		'image',
		'pagi',
		'siang',
		'malam',
	];
	// protected $hidden = [];
	// protected $dates = [];

	/**
	 * Food belongs to Merchant.
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
		$destination_path = "/foods";

		$this->uploadFile($value, $attribute_name, $disk, $destination_path);
	}
}
