<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HistoryRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\HistoryRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class HistoryCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\History');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/history');
		$this->crud->setEntityNameStrings('history', 'histories');

		$this->crud->setFromDb();
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
