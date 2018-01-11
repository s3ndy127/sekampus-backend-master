<?php

namespace App\Http\Traits;

trait InvoiceTrait {
	// Method generate invoice berdasarkan type pesanan
	// SMKN = seMakanan
	// SKRJ = seKeranjang
	// Default = Randomize + timestamps saat invoice di generate

	public function generateInvoice($type = null) {
		$charLength = 6;
		$randomize = strtoupper(str_shuffle(substr(str_repeat(md5(mt_rand()), 2 + $charLength / 32), 0, $charLength)));

		switch ($type) {
		case 'SMKN':
			return 'SMKN' . $randomize;
			break;

		case 'SKRJ':
			return 'SKRJ' . $randomize;
			break;

		default:
			return $randomize . time();
			break;
		}
	}
}