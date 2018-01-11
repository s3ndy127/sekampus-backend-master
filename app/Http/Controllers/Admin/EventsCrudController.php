<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventsRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventsRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class EventsCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Events');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/event/komunitas');
		$this->crud->setEntityNameStrings('Events', 'events');

		$this->crud->addFields([
			[
				'label' => "Komunitas",
				'type' => 'select2',
				'name' => 'komunitas_id',
				'entity' => 'komunitas',
				'attribute' => 'name',
				'model' => "App\Models\Komunitas",
			],
			[
				'name' => 'name',
				'label' => "Nama Event",
				'type' => 'text',
			],
			[
				'name' => 'description',
				'label' => "Deskripsi Event",
				'type' => 'textarea',
			],
			[
				'name' => 'image',
				'label' => 'Foto Event',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
		]);

		$this->crud->addColumns([
			[
				'name' => 'name',
				'label' => 'Nama Event',
				'type' => 'text',
			],
			[
				'label' => "Komunitas",
				'type' => "select",
				'name' => 'komunitas_id',
				'entity' => 'komunitas',
				'attribute' => "name",
				'model' => "App\Models\Komunitas",
			],
			[
				'name' => 'description',
				'label' => 'Deskripsi Event',
				'type' => 'text',
			],
			[
				'name' => 'image',
				'label' => "Foto Event",
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
