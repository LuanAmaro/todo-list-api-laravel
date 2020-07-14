<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Mockery\Expectation;

class UsersController extends Controller
{
    public function index()
    {
        return User::simplePaginate(10);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $userToUpdate = User::findOrFail($id);

        try {
            $userToUpdate = $userToUpdate->update(
                    $request->get('password') !== null ?
                    $request->all() :
                    $request->except('password')
            );
        } catch (Expectation $exception) {
            return response()->json([
                'errors' => [
                    'Não foi possível atualizar o usuário especificado.'
                ]
            ]);
        }

        return response()->json($userToUpdate);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'message' => 'Registro(s) Removido(s) com Sucesso'
        ]);
    }
}
