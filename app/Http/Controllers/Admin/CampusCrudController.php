<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CampusRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CampusRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class CampusCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Campus');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/campus');
		$this->crud->setEntityNameStrings('campus', 'campus');

		$this->crud->addFields([
			[
				'name' => 'name',
				'label' => 'Campus Name',
				'type' => 'text',
			],
			[
				'name' => 'address',
				'label' => "Campus Address",
				'type' => 'textarea',
			],
			[
				'name' => 'image',
				'label' => "Campus Photo",
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
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
		], 'both');

		$this->crud->addColumns(['name', 'address',
			[
				'name' => 'image',
				'label' => "Campus Photo",
				'type' => 'image',
			],
			'latitude', 'longitude',
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
}
