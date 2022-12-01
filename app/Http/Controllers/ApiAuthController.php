<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Validator;
class ApiAuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validator Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        // Generate Auth Token
        $success['token'] = $user->createToken("AuthToken")->accessToken;
        $success['account'] = $user;

        return $this->sendResponse($success, 'Account Created Successfully');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->get('email') , 'password' => $request->password])){
            $user = Auth::user();
            // $success['token'] = $user->createToken("AuthToken")->accessToken;
            $success['token'] = $user->createToken("AuthToken")->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'You Logged In Successfully!');
        }
        else{
            return $this->sendError('UnAuthenticated', ['error' => 'UnAuthorized..']);
        }
    }

    
}
