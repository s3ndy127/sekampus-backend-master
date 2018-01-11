<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
	use CrudTrait;

	protected $table = 'setting';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'nomor_rekening',
		'price',
		'distance',
		'isFlat',
	];
	// protected $hidden = [];
	// protected $dates = [];

}
