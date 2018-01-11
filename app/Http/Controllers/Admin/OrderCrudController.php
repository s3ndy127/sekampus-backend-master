<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\OrderRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class OrderCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Order');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/order');
		$this->crud->setEntityNameStrings('order', 'orders');

		$this->crud->setFromDb();

		$this->crud->removeButton('create');

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
