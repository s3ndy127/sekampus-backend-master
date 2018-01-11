<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryKomunitasRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CategoryKomunitasRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class CategoryKomunitasCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\CategoryKomunitas');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/category/komunitas');
		$this->crud->setEntityNameStrings('Category', 'category komunitas');

		$this->crud->addFields([
			[
				'name' => 'name',
				'label' => "Nama Category",
				'type' => 'text',
			],
			[
				'name' => 'description',
				'label' => "Deskripsi Category",
				'type' => 'textarea',
			],
			[
				'name' => 'image',
				'label' => 'Foto Category',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
		]);

		$this->crud->addColumns([
			[
				'name' => 'name',
				'label' => 'Nama Category',
				'type' => 'text',
			],
			[
				'name' => 'description',
				'label' => 'Deskripsi',
				'type' => 'text',
			],
			[
				'name' => 'image',
				'label' => "Foto Category",
				'type' => 'image',
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
}
