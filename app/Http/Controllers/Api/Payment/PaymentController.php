<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\PaymentConfirmation;
use Auth;

class PaymentController extends Controller {
	use ResponseTrait;

	public function create() {

		if (request()->payment_type === 'cash') {
			$status = 2;
			$payment = 'cash';
		} else {
			$status = 1;
			$payment = 'transfer';
		}

		$data = PaymentConfirmation::updateOrCreate(
			['user_id' => Auth::user()->id, 'order_id' => request()->invoice],

			['user_id' => Auth::user()->id, 'order_id' => request()->invoice, 'image' => request()->image, 'status' => $status, 'payment_type' => $payment]
		);

		return $this->response(false, $data, 'Berhasil menyimpan konfirmasi pembayaran');
	}

	public function getImage() {
		$data = PaymentConfirmation::select('image')
			->where('order_id', request()->invoice)
			->firstOrFail();

		return $this->response(false, $data, 'Menampilkan bukti pembayaran invoice ' . request()->invoice);
	}
}
