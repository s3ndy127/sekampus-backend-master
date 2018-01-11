<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReviewRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ReviewRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class ReviewCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Review');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/review');
		$this->crud->setEntityNameStrings('review', 'reviews');

		$this->crud->removeAllButtons();

		$this->crud->addColumns([
			[
				'label' => "User",
				'type' => "select",
				'name' => 'user_id',
				'entity' => 'user',
				'attribute' => "name",
				'model' => "App\Models\Review",
			],
			'invoice',
			[
				'label' => 'Rating',
				'type' => 'star',
			],
			'comment',
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
