<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Validator;

class APIAuthController extends Controller
{
    public function getToken(Request $request){
        // grab credentials from the request
       $credentials = $request->only('email', 'password');

       $validator = Validator::make($credentials, [
           'email' => 'required|email',
           'password' => 'required',
       ]);

       if ($validator->fails()) {
           throw new \Dingo\Api\Exception\StoreResourceFailedException('Please check your input', $validator->errors());
       }

       try {
           // attempt to verify the credentials and create a token for the user
           if (! $token = JWTAuth::attempt($credentials)) {
               return $this->response->error('Invalid Credentials', 401);
           }
       } catch (JWTException $e) {
           // something went wrong whilst attempting to encode the token
           return $this->response->error('Could not create token', 500);
       }

       // all good so return the token
       return response()->json(compact('token'));
    }
}
