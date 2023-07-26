<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserVerificationLogs;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;
use App\Mail\Auth\RegisterVerificationMail;
use App\Mail\Auth\RegisterSuccessMail;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'user_type' => 'required|in:SHOPOWNER,CUSTOMER,ADMIN',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        $now = Carbon::now();
        try {
            $input['password'] = Hash::make($input['password']);

            $userCheckIfExist = DB::table('users')->where('email', $input['email'])->first();
            if (isset($userCheckIfExist) && !empty($userCheckIfExist)) {

                return $this->sendError("This email address is already registered.");
            }
            if (isset($userCheckIfExist) && !empty($userCheckIfExist) && $userCheckIfExist->user_type !== $input['user_type']) {
                return $this->sendError("You are unauthorized to register, Please contact support.");
            }

            $user = User::create($input);
            $input['user_id'] = $user->id;
            $success['name'] =  $user->name;
            $token = randomPassword();

            return $this->sendResponse($success, 'User register successfully.');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {

            if (!isset($request->user_type)) {
                return $this->sendError('Please enter User Type.');
            }
            $userCheck = User::where('email', $request->email)->first();
            if (!isset($userCheck) && empty($userCheck)) {
                return $this->sendError('Invalid email address');
            }
            if ($userCheck->user_type !== $request->user_type) {
                return $this->sendError('You are not unauthorized to login, Please contact support.');
            }
            if (!Hash::check($request->password, $userCheck->password)) {
                return $this->sendError('Invalid Password');
            }
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $user = Auth::user();
            // DB::table('oauth_access_tokens')->where(['user_id' =>  $user->id, 'revoked' => 0])->update(['revoked' => 1]);
            $success['token'] =  $user->createToken($user->name)->accessToken;
            $success['name'] =  $user->name;
            $success['isSocial'] =  $user->type &&  $user->type != null ? true : false;

            return $this->sendResponse($success, 'User login successfully.');
        } catch (Exception $err) {
            return $this->sendError('Unauthorised.', [$err->getMessage()]);
        }
    }
}
