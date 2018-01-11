<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model {
	use CrudTrait;

	protected $table = 'campus';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = ['name', 'address', 'image', 'latitude', 'longitude'];
	// protected $hidden = [];
	// protected $dates = [];

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/campus";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}
}
