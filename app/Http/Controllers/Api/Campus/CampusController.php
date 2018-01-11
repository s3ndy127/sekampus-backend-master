<?php

namespace App\Http\Controllers\Api\Campus;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Campus;

class CampusController extends Controller {
	use DataTrait, ResponseTrait;

	public function index() {
		$this->table = new Campus;

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Data');
	}
}
