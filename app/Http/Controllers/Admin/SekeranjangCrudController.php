<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SekeranjangRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SekeranjangRequest as UpdateRequest;
use App\Models\Merchant;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class SekeranjangCrudController extends CrudController {
	public function setup() {

		$this->crud->setModel('App\Models\Sekeranjang');
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/sekeranjang');
		$this->crud->setEntityNameStrings('sekeranjang', 'sekeranjangs');

		// dd(Auth::user()->merchant);
		// $datas[Auth::user()->merchant->id] = Auth::user()->merchant->name;

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
				'attributes' => ['readonly' => 'readonly'],
			],
			[
				'name' => 'nama_barang',
				'label' => "Nama Barang",
				'type' => 'text',
			],
			[
				'name' => 'kategori',
				'label' => "Kategori Barang",
				'type' => 'select2_from_array',
				'options' => ["elektronik" => "Elektronik", "fashion" => "Fashion", "kuliah" => "Kebutuhan Kuliah"],
				'allows_null' => false,
			],
			[
				'name' => 'kondisi',
				'label' => "Kondisi",
				'type' => 'select2_from_array',
				'options' => ["baru" => "Baru", "bekas" => "Bekas"],
				'allows_null' => false,
			],
			[
				'name' => 'price',
				'label' => "Harga Barang",
				'type' => 'number',
				'prefix' => 'Rp. ',
			],
			[
				'name' => 'image',
				'label' => 'Foto Barang',
				'type' => 'upload',
				'upload' => true,
				'disk' => 'uploads',
			],
		]);

		$this->crud->addColumns([
			[
				'label' => "Merchant",
				'type' => "select",
				'name' => 'merchant_id',
				'entity' => 'merchant',
				'attribute' => "name",
				'model' => "App\Models\Merchant",
			], 'nama_barang', 'kategori', 'kondisi', 'price', [
				'name' => 'image',
				'label' => "Foto Barang",
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
