<?php

namespace App\Http\Controllers\Api\Komunitas;

use App\Http\Controllers\Controller;
use App\Http\Traits\DataTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Events;
use App\Models\Komunitas;
use Auth;

class KomunitasController extends Controller {
	use ResponseTrait, DataTrait;

	public function index() {
		$this->table = Komunitas::with('events');

		$data = $this->showData(request(), function ($q) {
			$q->where((isset(request()->field) ? request()->field : 'id'), 'like', '%' . request()->search . '%');
		});

		return $this->response(false, $data, 'Menampilkan Data Komunitas');
	}

	public function sendComment() {
		$comment = Events::findOrFail(request()->events_id);

		$comment->users()->attach(Auth::user()->id, ['comment' => request()->comment]);

		foreach ($comment->users() as $d) {
			dd($d->pivot);
		}

		return $this->response(false, null, 'Menampilkan Komentas Event');
	}
}
