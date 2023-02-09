<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// i have added
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Hash;

use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class UserController extends Controller
{
    //

    public function registration(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->error(), 202);
        }

        $allRequest = $request->all();
        $allRequest['password'] = Hash::make($allRequest['password']); //Hash::make($allRequest['password']); //bcrypt($allRequest['password']); // these method will support

        $user = User::create($allRequest);


        // Creating a token without scopes...
        $token = $user->createToken('api-application')->accessToken;

        // Creating a token without scopes...
        //$token = $user->createToken('Token Name', ['scope-name'])->accessToken;

        $result = [];
        $result['token'] = $token;

        return response()->json([
            'success' => "1",
            'message' => 'Registred',
            'data' => $result
        ], 200);
    }

    public function login(Request $request)
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $user = Auth::user();

            $token = $user->createToken('api-application')->accessToken;
            $name = $user->name;

            $result['token'] = $token;
            $result['name'] = $name;

            return response()->json($result, 200);
        } else {
            return response()->json(['error' => 'Unauthorized access'], 203);
        }
    }

    public function logout(Request $request)
    {

        //$user = Auth::user();
        $user = $request->user();
        $token = $request->user()->token();



        // Revoke a token by token
        $token->revoke();

        // to revoke all token of a user working method
        // $userTokens = $user->tokens;

        // foreach($userTokens as $token) {
        //     $token->revoke();   
        // }


        $tokenId = $user->token()->id;


        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        // Revoke an access token...
        //$tokenRepository->revokeAccessToken($tokenId); // working this

        // Revoke all of the token's refresh tokens...
        //$refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId); // not working all token delete




        $result = ['message' => "You have scuccessfully logged out"];

        return response()->json($result, 200);
    }
}
