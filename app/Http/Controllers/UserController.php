<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate(['name' => 'required|string', 'email' => 'required|string|email|unique:users,email,'.$user->id , 'password' => 'string|confirmed']);

        $request->merge(['password' => bcrypt($request->password)]);
        $user->update($request->all());

        return response()->json(['message' => 'Successfully Updated User!'], 200);
    }
}
