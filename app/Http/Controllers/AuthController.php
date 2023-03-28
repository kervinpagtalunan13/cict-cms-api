<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token, 'message' => 'login succesfully', 'user' => $request->user()]);
        }

        return response()->json(['message' => 'Invalid email or password'], 401);
    }

    public function register(Request $request)
    {
        // return isset($request['department']);
        $fields = $request->validate([
            'email' => 'required|string|unique:users,email',
            'username' => 'required|string|unique:users,username|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|string',
            'departmentId' => (isset($request['departmentId'])) ? 'required|string' : '',
        ]);

        $user = User::create([
            'email' => $fields['email'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
            'role' => 'admin',
            'department_id' => isset($fields['departmentId']) ? $fields['departmentId'] : null
        ]);

        if (isset($user['department_id'])) {
            $department = Department::find($user['department_id']);
            $members = json_decode($department->members, true);
            array_push($members, $user['id']);
            $department->members = json_encode($members);
            $department->save();
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
        return response($request, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getuser(Request $request)
    {
        $user = auth()->user();
        return response(['user' => $user]);
    }
}
