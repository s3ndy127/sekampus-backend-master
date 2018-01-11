<?php

namespace App\Http\Controllers\Api\FreemealOrder;

use App\Http\Controllers\Controller;
use App\Http\Traits\InvoiceTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Freemeal;
use App\Models\FreeMealItems;
use App\Models\History;
use App\Models\PaymentConfirmation;
use Auth;
use Illuminate\Http\Request;

class FreemealOrderController extends Controller {
	use ResponseTrait, InvoiceTrait;

	public function store(Request $request) {
		$data = Freemeal::create([
			'user_id' => Auth::user()->id,
			// 'merchant_id' => request()->merchant_id,
			'campus_id' => request()->campus_id,
			'invoice' => $this->generateInvoice(request()->invoice_type),
			'nama_penerima' => request()->nama_penerima,
			'telepon_penerima' => request()->telepon_penerima,
			'alamat_penerima' => request()->alamat_penerima,
			'catatan_penerima' => request()->catatan_penerima,
			'latitude' => request()->latitude,
			'longitude' => request()->longitude,
			'tanggal_kirim' => request()->tanggal_kirim,
			'price' => request()->price,
			'nama_kampus' => request()->nama_kampus,
			'catatan_makanan' => request()->catatan_makanan,
		]);

		foreach (request()->item as $d) {
			$dataItems = FreeMealItems::create([
				'order_id' => $data->id,
				'food_id' => $d['food_id'],
				'merchant_id' => $d['merchant_id'],
				'nama_makanan' => $d['nama_makanan'],
				'price' => $d['price'],
				'waktu_kirim' => $d['waktu_kirim'],
				'merchant_owner' => $d['merchant_owner'],
				'merchant_name' => $d['merchant_name'],
				'merchant_address' => $d['merchant_address'],
				'merchant_phone' => $d['merchant_phone'],
			]);
		}

		$history = History::create([
			'user_id' => Auth::user()->id,
			'invoice' => $data->invoice,
			'nama_penerima' => $data->nama_penerima,
			'tipe' => request()->type,
			'tipe_layanan' => request()->service_type,
			'tipe_invoice' => request()->invoice_type,
			'nama_kampus' => $data->nama_kampus,
			'total_price' => $data->price,
		]);

		return $this->response(false, $data, 'Berhasil Membuat Order!');

	}

	public function finish($id) {
		$data = PaymentConfirmation::where('order_id', $id)
			->firstOrFail();

		$data->status = 3;

		$data->save();

		return $this->response(false, $data, 'Order Telah Selesai.');
	}
}
