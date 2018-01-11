<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
	use CrudTrait;

	protected $table = 'slider';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = ['caption', 'location', 'type'];
	// protected $hidden = [];
	// protected $dates = [];

	public function setLocationAttribute($value) {
		$attribute_name = "location";
		$disk = "uploads";
		$destination_path = "/slider";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}
}
