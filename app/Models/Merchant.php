<?php

namespace App\Models;

use App\Http\Traits\SupportTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model {
	use CrudTrait, SupportTrait;

	protected $table = 'merchant';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'user_id',
		'name',
		'image',
		'image_real',
		'address',
		'telp',
		'owner',
		'latitude',
		'longitude',
		'type',
		'subType',
		'open_time',
		'close_time',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];
	// protected $dates = [];

	/**
	 * Merchant has many Foods.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function foods() {
		return $this->hasMany(Food::class);
	}

	/**
	 * Merchant has many Catering.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function catering() {
		return $this->hasMany(Catering::class);
	}

	public function setImageRealAttribute($value) {
		$attribute_name = "image_real";
		$disk = "uploads";
		$destination_path = "/merchant";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/merchant/thumbnail";

		$this->uploadFile($value, $attribute_name, $disk, $destination_path);
	}
}
