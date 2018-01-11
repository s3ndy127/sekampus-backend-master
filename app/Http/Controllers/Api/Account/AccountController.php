<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 *
 * @author Dias Taufik Rahman
 * @copyright 2017
 *
 */
class AccountController extends Controller {
	use Responsetrait, ResetsPasswords;

	/**
	 * @api {post} /account/auth User Authentication
	 * @apiName Auth
	 * @apiGroup Account
	 *
	 * @apiParam {String} email User Email.
	 * @apiParam {Password} password User Password.
	 *
	 * @apiSuccess {Boolean} Error false
	 * @apiSuccess {Object} Data Data Returned from Backend
	 * @apiSuccess {String} Message Login Berhasil.
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	{
	"error": false,
	"data": {
	"id": 2,
	"name": "User",
	"email": "user@test.com",
	"phone": null,
	"company": null,
	"created_at": "2017-07-12 14:17:55",
	"updated_at": "2017-07-12 14:17:55",
	"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTg4LjE2Ni4yMzkuNDE6MTIzNC9kaWFtb25kL2FwaS9hY2NvdW50L2F1dGgiLCJpYXQiOjE0OTk5ODU5MTUsImV4cCI6MTQ5OTk4OTUxNSwibmJmIjoxNDk5OTg1OTE1LCJqdGkiOiJKcmJEdlY3bHVGcGNKUkRGIiwic3ViIjoyLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIiwidXNlciI6eyJpZCI6Mn19.G_KyxLVVeEd1jn5a-hpVW4nBUBmeN8wNiTx0ABuzPy8"
	},
	"message": "Login Berhasil"
	}
	 *
	 * @apiVersion 2.0.0
	 */

	/**
	 * Login Method using JWT
	 *
	 * @var Object $accountInfo
	 * @var Array $credentials
	 * @throws JWTException
	 * @return Json Response
	 */
	public function login() {
		$credentials = request()->only(['email', 'password']);

		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return $this->response(true, null, 'Email / Password Salah!');
			} else {
				$accountInfo = Auth::user();
				$accountInfo->token = $token;
				Log::info($accountInfo->name . ', Logged in from Api Endpoint');
				return $this->response(false, $accountInfo, 'Login Berhasil');
			}
		} catch (JWTException $e) {
			return $this->response(true, null, $e->getMessage());
		}
	}

	/**
	 * @api {post} /account/register User Registration
	 * @apiName Register
	 * @apiGroup Account
	 *
	 * @apiParam {String} name User Name
	 * @apiParam {String} email User Email.
	 * @apiParam {Password} password User Password.
	 * @apiParam {String} phone User Phone Number.
	 *
	 * @apiSuccess {Boolean} Error false
	 * @apiSuccess {Object} Data Data Returned from Backend
	 * @apiSuccess {String} Message Pendaftaran User Berhasil.
	 *
	 * @apiVersion 2.0.0
	 */

	public function register(Request $request) {

		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|unique:users',
			'password' => 'required',
			'phone' => 'required',
		]);

		$data = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => app('hash')->make($request->password),
			'phone' => $request->phone,
			'company' => $request->company,
		]);

		$data->assignRole('User');

		$token = JWTAuth::attempt([
			'email' => $request['email'],
			'password' => $request['password'],
		]);

		$data->token = $token;

		Log::info($data->name . ', Registered from Api Endpoint');
		return $this->response(false, $data, 'Pendaftaran User Berhasil');
		// }
	}

	/**
	 * @api {post} /account/update User Profile Update
	 * @apiName Update
	 * @apiGroup Account
	 *
	 * @apiParam {String} name User Name
	 * @apiParam {String} phone User Phone Number.
	 * @apiParam {String} company User Company Name.
	 *
	 * @apiSuccess {Boolean} Error false
	 * @apiSuccess {Object} Data Data Returned from Backend
	 * @apiSuccess {String} Message Berhasil Memperbaharui Profile.
	 *
	 * @apiVersion 2.0.0
	 */

	public function update(Request $request) {
		$data = Auth::user();
		(isset($request['name']) ? $data->name = $request['name'] : '');
		(isset($request['phone']) ? $data->phone = $request['phone'] : '');
		$data->save();

		return $this->response(false, $data, 'Berhasil Memperbaharui Profile');
	}

	public function updateFcm() {
		$data = Auth::user();
		$data->fcm_token = request()->fcm_token;
		$data->save();

		return $this->response(false, $data, 'Berhasil Memperbaharui Fcm Token');

	}

	public function token(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'phone' => 'required',
		]);

		$user = User::where(function ($query) use ($request) {
			$query->where('email', $request['email'])
				->where('phone', $request['phone']);
		})->first();

		if (!$user) {
			return $this->response(true, null, 'Email / Nomor Telepon Salah');
		}

		$token = $this->broker()->createToken($user);
		return $this->response(false, $token, 'Berhasil Mendapatkan Token');

	}

	public function resetPasswordByToken(Request $request) {
		$this->validate($request, [
			'phone' => 'required',
			'email' => 'required',
			'password' => 'required|confirmed',
			'token' => 'required',
		]);

		$response = $this->broker()->reset(
			$this->credentials($request), function ($user, $password) {
				$this->resetPassword($user, $password);
			}
		);

		if ($response == Password::PASSWORD_RESET) {
			return $this->response(false, null, 'Password Berhasil Dirubah.');
		} else {
			return $this->response(true, null, 'Gagal Merubah Password.');
		}
	}
}
