<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class History extends Model {
	use CrudTrait;

	protected $table = 'history';
	//protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = ['user_id', 'invoice', 'nama_penerima', 'tipe', 'tipe_layanan', 'tipe_invoice', 'nama_kampus', 'total_price'];
	// protected $hidden = [];
	// protected $dates = [];
}
