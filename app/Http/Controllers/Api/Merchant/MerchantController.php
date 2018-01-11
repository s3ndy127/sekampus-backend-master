<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller {
	use DataTrait, ResponseTrait;

	public function get(Request $request) {
		$search_term = $request->input('q');

		if ($search_term) {
			$results = Merchant::where('name', 'LIKE', '%' . $search_term . '%')
				->get();
		} else {
			$results = Merchant::get();
		}

		return $results;
	}

	public function index() {
		switch (request()->type) {
		case 'seKeranjang':

			$this->table = Merchant::where('type', 'seKeranjang');
			break;

		default:

			switch (request()->subType) {
			case 'catering':

				$this->table = Merchant::with('catering')
					->where('type', 'seMakanan');

				break;

			default:

				$this->table = Merchant::with('foods')
					->where('type', 'seMakanan');

				break;
			}
			break;
		}

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Merchant');
	}
}
