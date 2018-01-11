<?php

namespace App\Http\Controllers\Api\History;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Cateringorder;
use App\Models\Freemeal;
use App\Models\History;
use App\Models\SekeranjangOrder;
use Auth;
use Carbon\Carbon as Carbon;

class HistoryController extends Controller {
	use ResponseTrait, DataTrait;

	public function index() {
		$this->table = History::where('user_id', Auth::user()->id);

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'invoice'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan History Akun ' . Auth::user()->name);

	}

	public function detail($invoice, $type) {

		if ($type) {
			switch ($type) {

			case 'dailymeal':
				$this->table = Freemeal::with('items')
					->where('invoice', $invoice);

				$data = $this->showData(request(), function ($q) {
					$q->where((isset(request()->field) ? request()->field : 'nama_penerima'), 'like', '%' . request()->search . '%');
				});

				$status = Freemeal::with('payment')
					->where('invoice', $invoice)->first();

				break;

			case 'catering':
				$this->table = Cateringorder::with('items.catering')
					->where('invoice', $invoice);

				$data = $this->showData(request(), function ($q) {
					$q->where((isset(request()->field) ? request()->field : 'nama_penerima'), 'like', '%' . request()->search . '%');
				});

				$status = Cateringorder::with('payment')
					->where('invoice', $invoice)->first();
				break;

			case 'sekeranjang':
				$this->table = SekeranjangOrder::where('invoice', $invoice);

				$data = $this->showData(request(), function ($q) {
					$q->where((isset(request()->field) ? request()->field : 'nama_penerima'), 'like', '%' . request()->search . '%');
				});

				$status = SekeranjangOrder::with('payment')
					->where('invoice', $invoice)->first();

				break;

			default:
				$data = 'Error';
				break;
			}
		}

		foreach ($data as $d) {
			$d->status = (isset($status->payment->status) ? $status->payment->status : 0);
		}

		return $this->response(false, $data, 'Menampilkan Detail History Akun ' . Auth::user()->name);

	}

	public function notification() {
		$totalFreemeal = Freemeal::where('created_at', '>=', Carbon::today())
			->count();

		$totalCatering = Cateringorder::where('created_at', '>=', Carbon::today())->count();

		return $this->response(false, compact("totalFreemeal", "totalCatering"), 'Freemeal & Catering Notification');
	}
}
