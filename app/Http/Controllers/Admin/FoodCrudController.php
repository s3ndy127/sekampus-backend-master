<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FoodRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FoodRequest as UpdateRequest;
use App\Models\Merchant;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class FoodCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Food');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/food');
		$this->crud->setEntityNameStrings('food', 'foods');

		$data = Merchant::select('id as id', 'name as text')->get();

		$datas = array();
		foreach ($data as $d => $value) {
			$datas[$value->id] = $value->text;
		}

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
				'label' => "Food Name",
				'type' => 'text',
			],
			[
				'name' => 'description',
				'label' => "Description",
				'type' => 'textarea',
			],
			[
				'name' => 'price',
				'label' => "Food Price",
				'type' => 'text',
			],
			[
				'name' => 'type',
				'label' => "Food Type",
				'type' => 'text',
			],
			[
				'name' => 'pagi',
				'label' => "Morning",
				'type' => 'checkbox',
			],
			[
				'name' => 'siang',
				'label' => "Evening",
				'type' => 'checkbox',
			],
			[
				'name' => 'malam',
				'label' => "Night",
				'type' => 'checkbox',
			],
			[
				'name' => 'image',
				'label' => 'Food Image',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
		], 'both');

		$this->crud->addColumns([
			[
				'label' => "Merchant",
				'type' => "select",
				'name' => 'merchant_id',
				'entity' => 'merchant',
				'attribute' => "name",
				'model' => "App\Models\Merchant",
			],
			'name', 'description',
			[
				'name' => 'image',
				'label' => "Food image",
				'type' => 'image',
			], 'price', 'type',
			[
				'name' => 'pagi',
				'label' => 'morning',
				'type' => 'check',
			],
			[
				'name' => 'siang',
				'label' => 'evening',
				'type' => 'check',
			],
			[
				'name' => 'malam',
				'label' => 'night',
				'type' => 'check',
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
		return $redirect_location;
	}
}
