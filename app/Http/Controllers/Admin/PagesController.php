<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PagesController extends Controller {
	public function ketentuan() {
		return view('pages.ketentuan');
	}
}
