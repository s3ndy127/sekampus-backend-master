<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SliderRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class SliderCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Slider');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/slider');
		$this->crud->setEntityNameStrings('slider', 'sliders');

		$this->crud->addFields([
			[
				'name' => 'caption',
				'label' => "Slider Caption",
				'type' => 'text',
			],
			[
				'name' => 'location',
				'label' => 'Slider Image',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
			[
				'name' => 'type',
				'label' => "Slider Type",
				'type' => 'enum',
			],
		], 'both');

		$this->crud->addColumns(['caption', [
			'name' => 'location',
			'label' => "Profile image",
			'type' => 'image',
		], 'type']);
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
