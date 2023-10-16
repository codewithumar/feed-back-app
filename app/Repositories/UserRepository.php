<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }
        $token = $user->createToken('login');

        $plainTextToken = $token->plainTextToken;

        return [
            'token' => $plainTextToken,
            'user' => $user,
        ];
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out',
        ];
    }

    public function create($data)
    {
        return User::create($data);
    }
    public function update($data, $id)
    {

        $record = User::find($id);
        return $record->update($data);
    }
    public function delete($id)
    {

        return User::destroy($id);
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }
}
