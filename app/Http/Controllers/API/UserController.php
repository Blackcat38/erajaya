<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

// Models
use App\Models\User;

class UserController extends Controller
{
    public function listuser()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);
        $user->get();

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true
        ], 200);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            'success' => true
        ], 200);
    }
}
