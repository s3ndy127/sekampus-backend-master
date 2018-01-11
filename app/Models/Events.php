<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Events extends Model {
	use CrudTrait;

	protected $table = 'events_sekomunitas';

	protected $fillable = [
		'komunitas_id',
		'name',
		'description',
		'image',
	];

	public function users() {
		return $this->belongsToMany('App\User', 'event_comments', 'user_id', 'komunitas_id')
			->withPivot('comment')
			->withTimeStamps();
	}

	public function komunitas() {
		return $this->belongsTo('App\Models\Komunitas', 'komunitas_id', 'id');
	}

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/events";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}
}
