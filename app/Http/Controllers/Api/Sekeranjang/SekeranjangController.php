<?php

namespace App\Http\Controllers\Api\Sekeranjang;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\InvoiceTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\History;
use App\Models\Sekeranjang;
use App\Models\SekeranjangOrder;
use Auth;

class SekeranjangController extends Controller {
	use DataTrait, ResponseTrait, InvoiceTrait;

	public function index() {
		$this->table = Sekeranjang::with('merchant');

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Data');
	}

	public function order() {
		$data = SekeranjangOrder::create([
			'user_id' => Auth::user()->id,
			'item_id' => request()->item_id,
			'merchant_id' => request()->merchant_id,
			'invoice' => $this->generateInvoice(request()->invoice_type),
			'nama_penerima' => request()->nama_penerima,
			'telepon_penerima' => request()->telepon_penerima,
			'catatan_penerima' => request()->catatan_penerima,
			'alamat_penerima' => request()->alamat_penerima,
			'catatan_lokasi' => request()->catatan_lokasi,
			'tanggal_kirim' => request()->tanggal_kirim,
			'latitude' => request()->latitude,
			'longitude' => request()->longitude,
			'waktu_cod' => request()->waktu_cod,
			'tipe_pembayaran' => request()->tipe_pembayaran,
			'price' => request()->price,
			'nama_item' => request()->nama_item,
			'invoice_type' => request()->invoice_type,
			'service_type' => request()->service_type,
			'merchant_owner' => request()->merchant_owner,
			'merchant_address' => request()->merchant_address,
			'merchant_phone' => request()->merchant_phone,
		]);

		$history = History::create([
			'user_id' => Auth::user()->id,
			'invoice' => $data->invoice,
			'nama_penerima' => $data->nama_penerima,
			'tipe' => request()->type,
			'tipe_layanan' => request()->service_type,
			'tipe_invoice' => request()->invoice_type,
			'nama_kampus' => request()->nama_kampus,
			'total_price' => $data->price,
		]);

		return $this->response(false, $data, 'Berhasil Membuat Order!');

	}
}
