<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CateringRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CateringRequest as UpdateRequest;
use App\Models\Merchant;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class CateringCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Catering');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/catering');
		$this->crud->setEntityNameStrings('catering', 'caterings');

		$data = Merchant::select('id as id', 'name as text')->get();

		$datas = array();
		foreach ($data as $d => $value) {
			$datas[$value->id] = $value->text;
		}

		// $id = \Route::current()->parameter('id');

		// $data = Merchant::select('id as id', 'name as text')->where('id', $id)->first();

		// $datas = array();
		// $datas[$data['id']] = $data['text'];

		$this->crud->addFields([
			[
				'name' => 'merchant_id',
				'label' => "Merchant",
				'type' => 'select2_from_array',
				'options' => $datas,
				'allows_null' => false,
			],
			[
				'name' => 'name',
				'label' => "Catering Name",
				'type' => 'text',
			],
			[
				'name' => 'price',
				'label' => "Catering Price",
				'type' => 'text',
			],
			[
				'name' => 'amount',
				'label' => "Catering Amount",
				'type' => 'number',
			],
		], 'both');

		$this->crud->addColumns([
			[
				'label' => "Merchant",
				'type' => "select",
				'name' => 'merchant_id',
				'entity' => 'merchant',
				'attribute' => "name",
				'model' => "App\Models\Catering",
			], 'name', 'price', 'amount', [
				'label' => 'Menu',
				'type' => 'cateringmenu',
			],

		]);

		// $this->crud->addButtonFromView('line', 'showmenu', 'showmenu', 'beginning');

		$this->crud->addButtonFromView('line', 'menu', 'menu', 'beginning');

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
