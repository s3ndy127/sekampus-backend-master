<?php

namespace App\Http\Traits;
use Image;

trait SupportTrait {
	/**
	 * Handle file upload and DB storage for a file:
	 * - on CREATE
	 *     - stores the file at the destination path
	 *     - generates a name
	 *     - stores the full path in the DB;
	 * - on UPDATE
	 *     - if the value is null, deletes the file and sets null in the DB
	 *     - if the value is different, stores the different file and updates DB value.
	 *
	 * @param  [type] $value            Value for that column sent from the input.
	 * @param  [type] $attribute_name   Model attribute name (and column in the db).
	 * @param  [type] $disk             Filesystem disk used to store files.
	 * @param  [type] $destination_path Path in disk where to store the files.
	 */
	public function uploadFile($value, $attribute_name, $disk, $destination_path) {
		$request = \Request::instance();

		// if a new file is uploaded, delete the file from the disk
		if ($request->hasFile($attribute_name) &&
			$this->{$attribute_name} &&
			$this->{$attribute_name} != null) {
			\Storage::disk($disk)->delete($this->{$attribute_name});
			$this->attributes[$attribute_name] = null;
		}

		// if the file input is empty, delete the file from the disk
		if (is_null($value) && $this->{$attribute_name} != null) {
			\Storage::disk($disk)->delete($this->{$attribute_name});
			$this->attributes[$attribute_name] = null;
		}

		// if a new file is uploaded, store it on disk and its filename in the database
		if ($request->hasFile($attribute_name) && $request->file($attribute_name)->isValid()) {
			// 1. Generate a new file name
			$file = $request->file($attribute_name);

			$new_file_name = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();

			// 2. Move the new file to the correct path
			$file_path = $file->storeAs($destination_path, $new_file_name, $disk);

			$img = Image::make($file);
			$img->resize(300, 300, function ($constraint) {
				$constraint->aspectRatio();
			})->save($file_path);

			// 3. Save the complete path to the database
			$this->attributes[$attribute_name] = $file_path;
			return $file_path;
		}
	}

	// Method send push notif Android
	public function sendNotif($judul, $pesan, $bigText, $bigSummary, $token) {
		$registrationId = $token;

		// Format pesan yang dikirim
		$msg = array
			(
			'title' => $judul,
			'body' => $pesan,
			'bigText' => $bigText,
			'bigSummary' => $bigSummary,
		);
		$fields = array
			(
			'registration_ids' => $registrationId,
			'data' => $msg,
		);

		// Token FCM
		$headers = array
			(
			'Authorization: key=AIzaSyAUq32AgyVH4_-yirN0sYkLg9Wuka2g3_Y',
			'Content-Type: application/json',
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);
	}
}