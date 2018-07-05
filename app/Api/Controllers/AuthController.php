<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/18
 * Time: 下午5:45
 */

namespace App\Api\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends BaseController
{
    /**
     * User register.
     *
     * @param $phone
     */
    public function register($phone)
    {
        $newUser = [
            'phone' => $phone,
            'register_time' => date('Y:m:d H:i:s')
        ];

        User::create($newUser);
    }

    /**
     * User auth.
     *
     * @param Request $request
     * @return mixed
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['message' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
