<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Setting;

class SettingController extends Controller {
	use ResponseTrait;
	public function index() {
		$data = Setting::findOrFail(1);

		return $this->response(false, $data, 'Menampilkan Setting');
	}
}
