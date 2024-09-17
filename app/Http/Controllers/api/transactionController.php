<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;


class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transactions =  transaction::all();
        return response()->json($transactions, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedData = Validator::make($request->all(), [

            'nom_client'=> 'required|string|max:255',
            'prenom_client'=> 'required|string|max:255',
            'addresse_client'=> 'required|string|max:255',
            "telephone_client" => 'required|string||max:15|unique:users',
            "sexe_client"=>'required|string|max:1',
            "age" => 'required|integer|max:100',
            "cni_client" => 'required|string|max:15',
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors()->all(), 400);
        }
        try {
            $transaction = transaction::create(array_merge($request->all(), ["id_client" => $this ->generateID()]));
            return response() ->json(['message' => 'User registered successfully'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erreur d\enregistrement'],200);
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction){
        $tr = transaction::find($transaction->id_trans);
        return response()->json($tr,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaction $transaction)
    {
        $validatedData = Validator::make($request->all(), [
           'montant' => 'required|numeric|min:0', 
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors()->all(), 400);
        }
        try {
            $new_transaction = transaction :: findOrFail($transaction->id_trans);
            $new_transaction->update($request->all());
            return response()->json(['message' => 'transaction updated successfully'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error while updating transaction'],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        $transaction_to_delete = transaction::findOrFail($transaction->id_trans);
        $transaction_to_delete ->delete();
        return response()->json(['message'=> 'transaction delete succeffuly'],200);
    }
    

    function generateID()
    {
        $id = 'U'.rand(100,999).'R';
        $transaction = transaction::where('id_transaction', $id)->first();
        if($transaction){
            return $this->generateID();
        }
        return $id;
    }
}
