<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
	use CrudTrait;

	protected $table = 'catering_menu';
	// protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'catering_id',
		'hari',
		'pagi',
		'siang',
		'malam',
		'image',
	];

	protected $casts = [
		'pagi' => 'array',
		'siang' => 'array',
		'malam' => 'array',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];
	// protected $dates = [];

	/**
	 * Menu belongs to Catering.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function catering() {
		// belongsTo(RelatedModel, foreignKey = catering_id, keyOnRelatedModel = id)
		return $this->belongsTo(Catering::class);
	}

	public function setImageAttribute($value) {
		$attribute_name = "image";
		$disk = "uploads";
		$destination_path = "/menu";

		$this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
	}
}
