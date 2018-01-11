<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sekost extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sekost';

	/**
	 * Fields that can be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nama_kost',
		'nama_pemilik',
		'nama_penjaga',
		'telp_pemilik',
		'telp_penjaga',
		'alamat',
		'latitude',
		'longitude',
		'waktu_buka',
		'waktu_tutup',
		'price',
		'mode_pembayaran',
		'fasilitas_umum',
	];

/**
 * Query builder scope to list neighboring locations
 * within a given distance from a given location
 *
 * @param  Illuminate\Database\Query\Builder  $query  Query builder instance
 * @param  mixed                              $lat    Lattitude of given location
 * @param  mixed                              $lng    Longitude of given location
 * @param  integer                            $radius Optional distance
 * @param  string                             $unit   Optional unit
 *
 * @return Illuminate\Database\Query\Builder          Modified query builder
 */
	public function scopeDistance($query, $lat, $lng, $radius = 100, $unit = "km") {

		$unit = ($unit === "km") ? 6378.10 : 3963.17;
		$lat = (float) $lat;
		$lng = (float) $lng;
		$radius = (double) $radius;
		return $query->having('distance', '<=', $radius)
			->select(DB::raw("*,
                            ($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(latitude))
                                * COS(RADIANS($lng) - RADIANS(longitude))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(latitude)))) AS distance")
			)->orderBy('distance', 'asc');
	}

}
