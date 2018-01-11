<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Storage;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $exception
	 * @return void
	 */
	public function report(Exception $exception) {
		parent::report($exception);
	}

	public function sendTelegram($url, array $textLog) {
		$chatId = "-230063777";

		$botToken = "439084771:AAEcRu8lYcsuROXpeTiplV7PM4aVhL9emxQ";

		$tempFile = 'sekampus_api_error_log.txt';

		$telegramApi = "https://api.telegram.org/bot$botToken/sendDocument";

		Storage::prepend($tempFile, '[Endpoint] API Url => ' . $url);
		Storage::append($tempFile, '[Log Error] Stack Trace => ' . json_encode($textLog));

		$data = array(
			'chat_id' => $chatId,
			'document' => new \CURLFile(storage_path() . '/' . $tempFile),
			'caption' => '[seKampus] Log Error API => ' . $url,
		);

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $telegramApi);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		curl_exec($curl);

		Storage::delete($tempFile);

		curl_close($curl);

		return true;
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception) {
		if ($request->is('api/*')) {

			if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
				return $exception->getResponse();
			} else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
				$message = 'Error 404 Not Found';
			} else if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
				$message = 'Method Not Allowed Exception';
			} else {
				$message = 'Terjadi Kesalahan';
			}

			$response = [];
			$response = [
				'error' => true,
				'message' => ($exception->getMessage() ? $exception->getMessage() : $message),
			];

			if (config('app.debug')) {
				$response['error_info'] = $exception->getTrace();
				$response['status_code'] = $exception->getCode();
			}

			$statusCode = method_exists($exception, 'getStatusCode')
			? $exception->getStatusCode()
			: 500;

			$response['status_code'] = $statusCode;

			Log::error(($exception->getMessage() ? $exception->getMessage() : $message));

			$this->sendTelegram($request->url(), $exception->getTrace());

			return response()->json($response);
		}

		return parent::render($request, $exception);
	}
}