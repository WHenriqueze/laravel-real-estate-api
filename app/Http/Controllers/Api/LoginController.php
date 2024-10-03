<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
  public function login(LoginRequest $request)
    {
      $user = User::where('email', $request->email)->first();

      if (! $user || ! Hash::check($request->password, $user->password)) {
         return response()->json([
           'message' => 'The provided credentials are incorrect.'
         ], 422);

      }

      return response()->json([
             'data' => [
             'attributes'=> [
                 'id' => $user->id,
                 'name' => $user->name,
                 'email' => $user->email
              ],
             'token' => $user->createToken('web')->plainTextToken
           ],
         ], 200);
    }
}
