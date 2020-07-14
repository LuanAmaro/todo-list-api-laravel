<?php

namespace App\Http\Controllers;

use App\TodoList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class TodoListsController extends Controller
{
    public function store(Request $request)
    {
        $todoList = null;
        $inputs = $request->all();

        try {
            DB::transaction(function () use (&$todoList, $inputs) {
                $todoList = TodoList::create($inputs);
            });
        } catch (Exception $exception) {
            return response()->json([
                'errors' => [
                    'Não foi possível criar uma nova lista, tenta novamente.',
                ]
            ], 500);
        }

        return response()->json($todoList);

    }

    public function index()
    {
        return TodoList::simplePaginate(10);
    }

    public function show($id)
    {
        return TodoList::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $data = $request->all();

        $list = TodoList::findOrFail($id);

        try{
            if($user->id !== $list->user_id){
                return response()->json([
                    'errors' => [
                        "Ops, não possível atualiza essa lista, por que ela não pertence a você, verifique-se se você esta no local corretamente!"
                    ]
                ]);
            }

            $list->update($data);

        }catch(Expectation $exception){
            return response()->json([
                'errors' => [
                    'Ops, não foi possivel atualizar essa lista, tenta novamente!'
                ]
                ], 500);
        }

        return response()->json([
            'code' => true,
            'data' => $list
        ]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $list = TodoList::findOrFail($id);
        try{

            if($user->id !== $list->user_id){
                return response()->json([
                    'errors' => [
                        'Ops, você não pode remover essa lista que não seja sua, verifique-se se você esta no local corretamente!'
                    ]
                ]);
            }

            $list->delete();

        }catch(Expectation $exception){
            return response()->json([
                'errors' => [
                    'Ops, não foi possivel remover essa lista, tenta novamente.'
                ]
            ], 500);
        }

        return response()->json([ 'code' => true ]);
    }

    public function checked(Request $request, $id)
    {
        $user = Auth::user();
        $data = $request->all();
        $list = TodoList::findOrFail($id);

        try{

            if($user->id !== $list->user_id){
                return response()->json([
                    'errors' => [
                        'Ops, você não pode marca essa lista como concluída, por que ela não é sua. Verifique-se se você esta no local corretamente!'
                    ]
                ]);
            }

            $list->update($data);
        }catch(Exception $exception){
            return response()->json([
                'errors' => [
                    'Ops, não foi possivel marcar essa lista como concluída, tenta novamente.'
                ]
            ]);
        }

        if($list->checked){
            $message = "Minha lista '{$list->description}' foi concluída.";
        }else{
            $message = "Minha lista '{$list->description}' foi desfeita.";
        }

        return response()->json(['message' => $message ]);

    }
}
