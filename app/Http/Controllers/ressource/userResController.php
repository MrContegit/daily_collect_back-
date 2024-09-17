<?php

namespace App\Http\Controllers\ressource;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\View\View;

class userResController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View{
        //
        // $users = User::all();
        return view('user.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedData = Validator::make($request->all(), [

            'nom' => 'required|string|max:255',
            'sexe' => 'required|string|max:1',
            'age' => 'required|integer|max:100',
            'telephone' => 'required|string||max:15|unique:users',
            'username' => 'required|string||max:15|unique:users',
            'password' => 'required|string||min:8',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors()->all(), 400);
        }
        try {
            $user = User::create(array_merge($request->all(), ["id_user" => $this->generateID()]));
            return response()->json(['message' => 'User registered successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erreur d\enregistrement'], 200);
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $u = User::find($user->id_user);
        return response()->json($u, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = Validator::make($request->all(), [

            'nom' => 'required|string|max:255',
            'sexe' => 'required|string|max:1',
            'age' => 'required|integer|max:100',
            'telephone' => 'required|string||max:15|unique:users',
            'username' => 'required|string||max:15|unique:users',
            'password' => 'required|string||min:8',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors()->all(), 400);
        }
        try {
            $new_user = User:: findOrFail($user->id_user);
            $new_user->update($request->all());
            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error while updating user'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user_to_delete = User::findOrFail($user->id_user);
        $user_to_delete->delete();
        return response()->json(['message' => 'user delete succeffuly'], 200);
    }


    function generateID()
    {
        $id = 'U' . rand(100, 999) . 'R';
        $user = User::where('id_user', $id)->first();
        if ($user) {
            return $this->generateID();
        }
        return $id;
    }
}
