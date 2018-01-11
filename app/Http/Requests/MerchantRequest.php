<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MerchantRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		// only allow updates if the user is logged in
		return \Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|min:3|max:255',
			'address' => 'required|min:3|max:255',
			'telp' => 'required|min:3|max:255',
			'owner' => 'required|min:3|max:255',
			'type' => 'required|min:3|max:255',
			'subType' => 'required|min:3|max:255',
			'latitude' => ['regex:            /^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/'],
			'longitude' => ['regex:/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/'],
		];
	}

	/**
	 * Get the validation attributes that apply to the request.
	 *
	 * @return array
	 */
	public function attributes() {
		return [
			//
		];
	}

	/**
	 * Get the validation messages that apply to the request.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			//
		];
	}
}
