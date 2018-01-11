<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SekeranjangOrderRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SekeranjangOrderRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class SekeranjangOrderCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\SekeranjangOrder');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/sekeranjangorder');
		$this->crud->setEntityNameStrings('sekeranjang/order', 'Order Sekeranjang');

		$this->crud->addColumns([
			'invoice',
			[
				'label' => "Pemesan",
				'type' => "select",
				'name' => 'user_id',
				'entity' => 'users',
				'attribute' => "name",
				'model' => "App\User",
			],
			[
				'label' => "Merchant",
				'type' => "select",
				'name' => 'merchant_id',
				'entity' => 'merchant',
				'attribute' => "name",
				'model' => "App\Models\Merchant",
			],
			'alamat_penerima',
			[
				'name' => 'telepon_penerima',
				'label' => 'Telepon Pemesan',
			],
			[
				'name' => 'catatan_penerima',
				'label' => 'Catatan',
			],
			[
				'name' => 'catatan_lokasi',
				'label' => 'Catatan Lokasi',
			],
			[
				'name' => 'waktu_cod',
				'label' => 'Waktu COD',
			],
			[
				'name' => 'tipe_pembayaran',
				'label' => 'Jenis Pembayaran',
			],
			[
				'label' => "Barang",
				'type' => "select",
				'name' => 'item_id',
				'entity' => 'item',
				'attribute' => "nama_barang",
				'model' => "App\Models\Sekeranjang",
			],
			[
				'name' => 'price',
				'label' => 'Total Biaya',
			],
			[
				'name' => 'created_at',
				'label' => 'Waktu Pemesanan',
			],
			[
				'label' => "Status",
				'type' => "status",
				'name' => 'order_id',
				'entity' => 'payment',
				'attribute' => "id",
				'model' => "App\Models\PaymentConfirmation",
			],
		]);

		$this->crud->removeAllButtons();

		$this->crud->enableExportButtons();

		$this->crud->orderBy('created_at', 'DESC');

	}

	public function store(StoreRequest $request) {
		// your additional operations before save here
		$redirect_location = parent::storeCrud($request);
		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry
		return $redirect_location;
	}

	public function update(UpdateRequest $request) {
		// your additional operations before save here
		$redirect_location = parent::updateCrud($request);
		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry
		return $redirect_location;
	}
}
