<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SekeranjangOrder extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'nama_penerima' => 'required',
			'telepon_penerima' => 'required',
			'alamat_penerima' => 'required',
			'tanggal_kirim' => 'required',
			'latitude' => 'required',
			'longitude' => 'required',
			'price' => 'required',
			'merchant_owner' => 'required',
			'merchant_address' => 'required',
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
