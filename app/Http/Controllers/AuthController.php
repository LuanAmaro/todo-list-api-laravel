<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $userCreated = null;
        $inputs = $request->all();

        $register = function () use ($inputs, &$userCreated) {
            $userCreated = User::create($inputs);
        };

        try {
            DB::transaction($register);
        } catch (Exception $exception) {
            return response()->json([
                'errors' => ['Não foi possível registrar este usuário.']
            ], 500);
        }

        return response()->json($userCreated);
    }

}
