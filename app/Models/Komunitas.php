<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model {
	use CrudTrait;

	protected $table = 'komunitas';

	protected $fillable = [
		'category_id',
		'name',
		'description',
		'image',
	];

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/komunitas";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}

	public function events() {
		return $this->hasMany('App\Models\Events', 'komunitas_id', 'id');
	}

	public function category() {
		return $this->belongsTo('App\Models\CategoryKomunitas', 'category_id', 'id');
	}
}