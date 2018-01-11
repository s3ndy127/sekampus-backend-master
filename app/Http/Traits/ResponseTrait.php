<?php

namespace App\Http\Traits;

trait ResponseTrait {
	// Method response json yang sudah di format
	// API Android
	public function response($error = false, $data, $message) {
		return response()->json([
			'error' => $error,
			'data' => $data,
			'message' => $message,
		]);
	}
}