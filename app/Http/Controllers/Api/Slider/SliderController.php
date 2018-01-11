<?php

namespace App\Http\Controllers\Api\Slider;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Campus;
use App\Models\CategoryKomunitas;
use App\Models\Merchant;
use App\Models\Slider;

class SliderController extends Controller {
	use ResponseTrait, DataTrait;

	public function index() {
		if (request()->type === 'home') {
			$slider = Slider::where('type', request()->type)
				->get();

			$merchant = Merchant::get();

			$response = [
				'slider' => $slider,
				'merchant' => $merchant,
			];

		} else if (request()->type === 'campus') {
			$slider = Slider::where('type', request()->type)
				->get();

			$campus = Campus::get();

			$response = [
				'slider' => $slider,
				'campus' => $campus,
			];
		} else if (request()->type === 'komunitas') {
			$slider = Slider::where('type', request()->type)
				->get();

			$this->table = CategoryKomunitas::with('komunitas');

			$komunitas = $this->showData(request(), function ($q) {
				$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
			}, null, 'type');

			$response = [
				'slider' => $slider,
				'category' => $komunitas,
			];
		} else {
			$slider = Slider::where('type', request()->type)
				->get();

			$response = [
				'slider' => $slider,
			];
		}

		return $this->response(false, $response, 'Menampilkan Slider dan Data');
	}
}
