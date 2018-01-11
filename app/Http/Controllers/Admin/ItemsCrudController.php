<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ItemRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class ItemsCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\SekeranjangItems');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/items');
		$this->crud->setEntityNameStrings('items', 'Barang');

		$this->crud->addFields([
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
			[ // select_from_array
				'name' => 'type',
				'label' => "Merchant Type",
				'type' => 'select2_from_array',
				'options' => ["seMakanan" => "seMakanan", "seKeranjang" => "seKeranjang"],
				'allows_null' => false,
			],
			[
				'name' => 'image',
				'label' => 'Merchant Image',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
		], 'both');

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
