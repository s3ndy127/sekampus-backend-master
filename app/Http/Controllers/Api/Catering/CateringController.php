<?php

namespace App\Http\Controllers\Api\Catering;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\InvoiceTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Catering;
use App\Models\Cateringorder;
use App\Models\History;
use App\Models\Menu;
use Auth;

class CateringController extends Controller {
	use DataTrait, ResponseTrait, InvoiceTrait;

	public function detail($id) {
		$this->table = Catering::with('menu')
			->where('merchant_id', $id);

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Data');
	}

	public function menu($id) {
		$this->table = Menu::where('catering_id', $id);

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Menu Catering');
	}

	public function store() {
		$data = Cateringorder::create([
			'user_id' => Auth::user()->id,
			// 'merchant_id' => request()->merchant_id,
			'campus_id' => request()->campus_id,
			'catering_id' => request()->catering_id,
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

		return $this->response(false, $data, 'Berhasil Menyimpan Data Order');
	}
}
