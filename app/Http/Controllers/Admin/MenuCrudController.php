<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\MenuRequest as UpdateRequest;
use App\Models\Catering;
use App\Models\Food;
use App\Models\Menu;
use App\Models\Merchant;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class MenuCrudController extends CrudController {

	public function setup() {

		$id = \Route::current()->parameter('id');
		$menu = \Route::current()->parameter('menu');

		// dd($id);
		$this->crud->setModel('App\Models\Menu');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/menu');
		$this->crud->setEntityNameStrings('menu', 'menus');

		if (isset($id)) {
			$data = Merchant::select('id as id', 'name as text')
				->where('id', Catering::where('id', $id)->first()->merchant_id)
				->first();

			$datas = array();
			$datas[$data['id']] = $data['text'];

			$food = Food::select('id as id', 'name as text')
				->where('merchant_id', $data['id'])->get();

			$foodDatas = array();
			foreach ($food as $d => $value) {
				$foodDatas[$value->text] = $value->text;
			}

			$this->crud->addFields([
				[
					'name' => 'merchant_id',
					'label' => "Merchant",
					'type' => 'select2_from_array',
					'options' => $datas,
					'allows_null' => false,
					'attributes' => ['readonly' => 'readonly'],
				],
				[
					'name' => 'catering_id',
					'type' => 'hidden',
					'value' => $id,
				],
				[
					'name' => 'hari',
					'label' => "Hari",
					'type' => 'select2_from_array',
					'options' => [
						'Hari ke-1' => 'Hari ke-1',
						'Hari ke-2' => 'Hari ke-2',
						'Hari ke-3' => 'Hari ke-3',
						'Hari ke-4' => 'Hari ke-4',
						'Hari ke-5' => 'Hari ke-5',
						'Hari ke-6' => 'Hari ke-6',
						'Hari ke-7' => 'Hari ke-7',
					],
					'allows_null' => false,
				],
				[
					'name' => 'pagi',
					'label' => "Pagi",
					'type' => 'select2_from_array',
					'options' => $foodDatas,
					'allows_null' => false,
					'allows_multiple' => true,
				],
				[
					'name' => 'siang',
					'label' => "Siang",
					'type' => 'select2_from_array',
					'options' => $foodDatas,
					'allows_null' => false,
					'allows_multiple' => true,
				],
				[
					'name' => 'malam',
					'label' => "Malam",
					'type' => 'select2_from_array',
					'options' => $foodDatas,
					'allows_null' => false,
					'allows_multiple' => true,
				],
				[
					'name' => 'image',
					'label' => 'Image',
					'type' => 'upload',
					'upload' => true,
					'disk' => 'uploads',
				],
			], 'create');

		} else if (isset($menu)) {
			// $data = Merchant::select('id as id', 'name as text')
			// 	->where('id', $id)->first();

			$food = Food::where('merchant_id', Menu::with('catering')->where('id', $menu)->first()->catering->merchant_id)->get();

			// dd($food);

			$foodDatas = array();
			foreach ($food as $d => $value) {
				$foodDatas[$value->name] = $value->name;
				// dd($value);
			}

			$this->crud->addFields([
				[
					'name' => 'catering_id',
					'type' => 'hidden',
					// 'value' => $id,
				],
				[
					'name' => 'hari',
					'label' => "Hari",
					'type' => 'select2_from_array',
					'options' => [
						'Hari ke-1' => 'Hari ke-1',
						'Hari ke-2' => 'Hari ke-2',
						'Hari ke-3' => 'Hari ke-3',
						'Hari ke-4' => 'Hari ke-4',
						'Hari ke-5' => 'Hari ke-5',
						'Hari ke-6' => 'Hari ke-6',
						'Hari ke-7' => 'Hari ke-7',
					],
					'allows_null' => false,
				],
				[
					'name' => 'pagi',
					'label' => "Pagi",
					'type' => 'select2_from_array',
					'options' => $foodDatas,
					'allows_null' => false,
					'allows_multiple' => true,
				],
				[
					'name' => 'siang',
					'label' => "Siang",
					'type' => 'select2_from_array',
					'options' => $foodDatas,
					'allows_null' => false,
					'allows_multiple' => true,
				],
				[
					'name' => 'malam',
					'label' => "Malam",
					'type' => 'select2_from_array',
					'options' => $foodDatas,
					'allows_null' => false,
					'allows_multiple' => true,
				],
				[
					'name' => 'image',
					'label' => 'Image',
					'type' => 'upload',
					'upload' => true,
					'disk' => 'uploads',
				],
			], 'edit');
		}

		$this->crud->addColumns([
			[
				'label' => "Nama Katering",
				'type' => "select",
				'name' => 'catering_id',
				'entity' => 'catering',
				'attribute' => "name",
				'model' => "App\Models\Catering",
			], 'hari', [
				'name' => 'pagi',
				'label' => "Pagi",
				'type' => 'array',
			],
			[
				'name' => 'siang',
				'label' => 'Siang',
				'type' => 'array',
			],
			[
				'name' => 'malam',
				'label' => 'Malam',
				'type' => 'array',
			],
			[
				'name' => 'image',
				'label' => "Image",
				'type' => 'image',
			],
		]);

	}

	public function store(StoreRequest $request) {
		// your additional operations before save here
		parent::storeCrud($request);
		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry
		return redirect('/admin/catering');
		// return $redirect_location;
	}

	public function update(UpdateRequest $request) {
		// your additional operations before save here
		parent::updateCrud($request);
		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry
		return redirect('/admin/catering');

		// return $redirect_location;
	}

	public function addMenu($id) {

		$this->data['crud'] = $this->crud;
		$this->data['saveAction'] = $this->getSaveAction();
		$this->data['fields'] = $this->crud->getCreateFields();
		$this->data['title'] = trans('backpack::crud.add') . ' ' . $this->crud->entity_name;

		return view($this->crud->getCreateView(), $this->data);
	}

	public function editMenu($id) {
		// get the info for that entry
		$data = Menu::findOrFail($id);

		$this->data['entry'] = $data;
		$this->data['crud'] = $this->crud;
		$this->data['saveAction'] = $this->getSaveAction();
		$this->data['fields'] = $this->getCustomUpdateFields($data);
		$this->data['title'] = trans('backpack::crud.edit') . ' ' . $this->crud->entity_name;

		$this->data['id'] = $id;

		// load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
		return view($this->crud->getEditView(), $this->data);
	}

	public function destroy($delete) {

		Menu::findOrFail($delete)->delete();

		return redirect()->back();
	}
}
