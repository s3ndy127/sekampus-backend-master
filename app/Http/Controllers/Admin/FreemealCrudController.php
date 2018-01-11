<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FreemealRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FreemealRequest as UpdateRequest;
use App\Http\Traits\SupportTrait;
use App\Models\PaymentConfirmation;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class FreemealCrudController extends CrudController {
	use SupportTrait;

	public function setup() {

		$this->crud->setModel('App\Models\Freemeal');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/freemeal');
		$this->crud->setEntityNameStrings('freemeal', 'Order Freemeal');

		$this->crud->enableExportButtons();

		$this->crud->addColumns([
			'invoice',
			[
				'label' => "Pemesan",
				'type' => "select",
				'name' => 'user_id',
				'entity' => 'user',
				'attribute' => "name",
				'model' => "App\User",
			], 'alamat_penerima',
			[
				'name' => 'price',
				'label' => 'Total Biaya',
			],
			[
				'name' => 'catatan_penerima',
				'label' => 'Catatan Pemesan',
			],
			[
				'name' => 'catatan_makanan',
				'label' => 'Catatan Makanan',
			],
			[
				'name' => 'created_at',
				'label' => 'Waktu Pemesanan',
			],
			[
				'name' => 'telepon_penerima',
				'label' => 'Telepon Pemesan',
			],
			[
				'label' => 'Pesanan',
				'type' => 'pesanan',
			],
			[
				'name' => 'Metode',
				'type' => 'metode',
			],
			[
				'label' => "Bukti Bayar",
				'type' => "bukti",
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

		$this->crud->addButtonFromView('line', 'accept', 'accept', 'beginning');

		$this->crud->removeButton('create');
		$this->crud->removeButton('update');
		$this->crud->removeButton('delete');

		// ------ CRUD ACCESS
		$this->crud->allowAccess(['list', 'accept']);

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

	public function accept($id) {
		$data = PaymentConfirmation::where('order_id', $id)
			->firstOrFail();

		// Set status order menjadi diterima (2)
		$data->status = 2;

		$data->save();

		$fcmToken = User::where('id', $data->user_id)->first();

		\Alert::success('Pembayaran Berhasil Dikonfirmasi')->flash();

		// Kirim notifikasi ke Android
		$this->sendNotif('Konfirmasi Pembayaran', 'Pembayaran Berhasil Dikonfirmasi', 'Pembayaran Berhasil Dikonfirmasi Dengan Invoice ' . $data->order_id, 'seMakanan', array($fcmToken->fcm_token));

		return \Redirect::to($this->crud->route);
	}

	public function finish($id) {
		$data = PaymentConfirmation::where('order_id', $id)
			->firstOrFail();

		// Set status order menjadi finish (4)
		$data->status = 4;

		$data->save();

		$fcmToken = User::where('id', $data->user_id)->first();

		\Alert::success('Pesanan Berhasil Diselesaikan')->flash();

		// Kirim notifikasi ke Android
		$this->sendNotif('Selamat! Pesanan Telah Selesai', 'Pesanan Selesai', 'Pesanan Dengan Invoice ' . $data->order_id . ' Berhasil Diselesaikan, Terima Kasih', 'seMakanan', array($fcmToken->fcm_token));

		return \Redirect::to($this->crud->route);
	}
}
