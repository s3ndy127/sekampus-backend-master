<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\KomunitasRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\KomunitasRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class KomunitasCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Komunitas');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/komunitas');
		$this->crud->setEntityNameStrings('komunitas', 'komunitas');

		$this->crud->addFields([
			[
				'label' => "Category",
				'type' => 'select2',
				'name' => 'category_id',
				'entity' => 'category',
				'attribute' => 'name',
				'model' => "App\Models\CategoryKomunitas",
			],
			[
				'name' => 'name',
				'label' => "Nama Komunitas",
				'type' => 'text',
			],
			[
				'name' => 'description',
				'label' => "Deskripsi Komunitas",
				'type' => 'textarea',
			],
			[
				'name' => 'image',
				'label' => 'Foto Komunitas',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
		]);

		$this->crud->addColumns([
			[
				'name' => 'name',
				'label' => 'Nama Komunitas',
				'type' => 'text',
			],
			[
				'label' => "Category",
				'type' => "select",
				'name' => 'category_id',
				'entity' => 'category',
				'attribute' => "name",
				'model' => "App\Models\CategoryKomunitas",
			],
			[
				'name' => 'description',
				'label' => 'Deskripsi',
				'type' => 'text',
			],
			[
				'name' => 'image',
				'label' => "Foto Komunitas",
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
