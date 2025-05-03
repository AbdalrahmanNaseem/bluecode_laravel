<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;


class UserController extends Controller
{
    public function all_users()
    {
        $users = User::all();
        return response()->json($users, 200);
    }
    public function update_user_info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            "name" => 'nullable|string|min:4',
            'email' => 'nullable|email|unique:users,email,' . $request->user_id,
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|required_with:old_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $data = $validator->validated();

        $user = User::find($request->id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        if (isset($data['name'])) $user->name = $data['name'];
        if (isset($data['email'])) $user->email = $data['email'];
        if (isset($data['country'])) $user->country = $data['country'];

        if (!empty($data['old_password'])  && !empty($data['new_password'])) {
            if (!Hash::check($data['old_password'], $user->password)) {
                return response()->json([
                    'message' => 'Old password is incorrect'
                ], 400);
            }

            $user->password = Hash::make($data['new_password']);
        }


        $user->save();
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ], 200);
    }
    public function get_user_by_id($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json([
                "message" => "user is not found"
            ], 404);
        }
        return response($user);
    }



    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|exists:users,email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => ' ancourect password '], 401);
        }

        return response()->json([
            'message' => "login success",
            'user'    => $user,
        ], status: 200);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255|unique:users,name',
            'country'     => 'required|string|max:255|',
            'phone'     => 'required|string|max:255|',
            'FullName'     => 'required|string|max:255|unique:users,name',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        if (User::where('email', $data['email'])->exists()) {
            return response()->json([
                'message' => 'email is exist'
            ], 422);
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'register success',
            'user'    => $user,
        ], 201);
    }
}
