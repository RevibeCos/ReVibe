<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{

    public function register(RegisterRequest $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            'email' => 'required|email',
//            'password' => 'required',
//            'c_password' => 'required|same:password',
//        ]);
//
//        if ($validator->fails()) {
//            return $this->sendError('Validation Error.', $validator->errors());
//        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        $success['phone_number'] = $user->phone_number;

        return response_api(true, 200, 'User register successfully');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

//            return $this->sendResponse($success, 'User login successfully.');
            return response_api(true, 200, 'User login successfully');

        } else {
            return response_api(false, 401, message(401));
//            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
