<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\Cateringorder;
use App\Models\Freemeal;
use App\Models\Review;
use App\Models\SekeranjangOrder;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller {
	use ResponseTrait;

	public function store() {

		if ($this->setIsReviewed(request()->type, request())) {
			$data = Review::create([
				// 'merchant_id' => request()->merchant_id,
				'user_id' => Auth::user()->id,
				'invoice' => request()->invoice,
				'rating' => request()->rating,
				'comment' => request()->comment,
				'type' => request()->type,
			]);

			return $this->response(false, $data, 'Berhasil memberikan review');

		} else {
			return $this->response(true, null, 'Gagal memberikan review');
		}

	}

	public function setIsReviewed($type, $data) {

		switch ($type) {

		case 'freemeal':
			$data = Freemeal::where('invoice', $data->invoice)
				->firstOrFail();
			$data->is_reviewed = true;
			$data->save();

			return true;
			break;

		case 'catering':
			$data = Cateringorder::where('invoice', $data->invoice)
				->firstOrFail();
			$data->is_reviewed = true;
			$data->save();

			return true;
			break;

		case 'sekeranjang':
			$data = SekeranjangOrder::where('invoice', $data->invoice)
				->firstOrFail();

			$data->is_reviewed = true;
			$data->save();

			return true;
			break;

		default:
			return false;
			break;

		}
	}
}
