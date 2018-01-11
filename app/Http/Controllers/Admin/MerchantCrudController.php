<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MerchantRequest as StoreRequest;
use App\Http\Requests\MerchantRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class MerchantCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Merchant');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/merchant');
		$this->crud->setEntityNameStrings('merchant', 'Daftar Merchant');

		// $data = User::select('id as id', 'name as text')->get();

		// $datas = array();
		// foreach ($data as $d => $value) {
		// 	$datas[$value->id] = $value->text;
		// }

		$this->crud->addFields([
			// [
			// 	'name' => 'user_id',
			// 	'label' => "User",
			// 	'type' => 'select2_from_array',
			// 	'options' => $datas,
			// 	'allows_null' => false,
			// ],
			[
				'name' => 'name',
				'label' => "Merchant Name",
				'type' => 'text',
			],
			[
				'name' => 'address',
				'label' => "Merchant Address",
				'type' => 'textarea',
			],
			[
				'name' => 'telp',
				'label' => "Merchant Phone",
				'type' => 'text',
			],
			[
				'name' => 'owner',
				'label' => "Merchant Owner",
				'type' => 'text',
			],
			[
				'name' => 'latitude',
				'label' => "Latitude",
				'type' => 'text',
			],
			[
				'name' => 'longitude',
				'label' => "Longitude",
				'type' => 'text',
			],
			[
				'name' => 'type',
				'label' => "Merchant Type",
				'type' => 'select2_from_array',
				'options' => ["seMakanan" => "seMakanan", "seKeranjang" => "seKeranjang"],
				'allows_null' => false,
			],
			[
				'name' => 'subType',
				'label' => "Sub Type",
				'type' => 'select2_from_array',
				'options' => ["freemeal" => "Freemeal", "catering" => "Catering", "toko" => "Toko"],
				'allows_null' => false,
			],
			[
				'name' => 'image',
				'label' => 'Merchant Image',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
			[
				'name' => 'open_time',
				'label' => 'Waktu Buka',
				'type' => 'datetime_picker',
				'datetime_picker_options' => [
					'defaultDate' => null,
					'format' => 'HH:mm:ss',
					// 'defaultDate' => 'd',
				],
			],
			[
				'name' => 'close_time',
				'label' => 'Waktu Tutup',
				'type' => 'datetime_picker',
				'datetime_picker_options' => [
					'defaultDate' => null,
					'format' => 'HH:mm:ss',
					// 'defaultDate' => 'd',
				],
			],
		], 'both');

		$this->crud->addColumns(['id', 'name', 'address', 'telp',
			[
				'name' => 'open_time',
				'label' => 'Waktu Buka',
			],
			[
				'name' => 'close_time',
				'label' => 'Waktu Tutup',
			],
			'owner', [
				'name' => 'image',
				'label' => "Merchant Image",
				'type' => 'image',
			], 'latitude', 'longitude', 'type', 'subType',
		]);

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
