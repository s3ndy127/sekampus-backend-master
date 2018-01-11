<?php

namespace App\Http\Controllers\Api\SeKost;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Sekost;

class SeKostController extends Controller {
	use DataTrait, ResponseTrait;

	public function index() {
		$this->table = new Sekost;

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Data Kost');
	}

	public function nearby() {

		if (request()->type === 'campus') {
			$latitude = -6.973767;
			$longitude = 107.630380;
			$distance = 3;
		} else {
			$latitude = request()->latitude;
			$longitude = request()->longitude;
			$distance = request()->distance;
		}

		$data = Sekost::Distance($latitude, $longitude, $distance)->get();

		return $this->response(false, $data, 'Menampilkan Data Kost Sekitar');
	}
}
