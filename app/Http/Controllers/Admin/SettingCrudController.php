<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SettingRequest as UpdateRequest;
use App\Http\Traits\SupportTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class SettingCrudController extends CrudController {
	use SupportTrait;

	public function setup() {

		$this->crud->setModel('App\Models\Setting');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/setting');
		$this->crud->setEntityNameStrings('setting', 'settings');

		$this->crud->addFields([
			[
				'name' => 'nomor_rekening',
				'label' => "Nomor Rekening",
				'type' => 'text',
			],
			[
				'name' => 'price',
				'label' => "Harga",
				'type' => 'number',
				'prefix' => 'Rp. ',
			],
			[
				'name' => 'distance',
				'label' => "Jarak",
				'type' => 'number',
			],
			[
				'name' => 'isFlat',
				'label' => "Tarif Flat",
				'type' => 'checkbox',
			],
		]);

		$this->crud->addColumns([
			[
				'name' => 'nomor_rekening',
				'label' => 'Nomor Rekening seKampus',
			],
			[
				'name' => 'price',
				'label' => 'Harga',
			],
			[
				'name' => 'distance',
				'label' => 'Jarak',
			],
			[
				'name' => 'isFlat',
				'label' => 'Tarif Flat',
				'type' => 'boolean',
			],
		]);

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

	public function test() {
		$this->sendNotif('Selamat! Pesanan Telah Selesai', 'Pesanan Selesai', 'Pesanan Dengan Invoice xxx Berhasil Diselesaikan, Terima Kasih', 'seMakanan', array('eFxEYcg7UDQ:APA91bEQKDDYzIiCRFDbfmFCL4N5ovIoyiFlC7z4n5V-cZbbznaE8AwF7dhBGp7FfB4P_-Hn8inUj7ZU17dZfYDu-0qym2M_383ZyZ8uETCeJcA5ZJxdx3yxOb7i9h0fkfhhE8i4XMSn'));

	}
}
