<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!isset($user->id)) {
            return response()->json([
                'success' => false,
                "msg" => "User has not been registered yet.",
            ],404);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                "msg" => "Incorrect data.",
            ],404);
        }
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            'success' => true,
            "msg" => "Successfully logged in!",
            "access_token" => $token,
        ],200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'success' => true,
            "msg" => "Successfully logged out.",
        ],200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);


        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role_std = Role::where('name', 'student')->first();
        $user->role()->associate($role_std);
        $user->save();

        event(new Registered($user));
        Auth::login($user);

        return response()->json([
            'success' => true,
            'msg' => 'Successfully signed up user!'
        ],200);
    }

    public function profile() {
        return response()->json([
            'success' => true,
            'msg' => 'About user',
            'data' => Auth::user()->makeHidden(['email_verified_at']),
        ]);
    }

    public function profileUpdate(ProfileUpdateRequest $request) {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();
        return response()->json([
            'success' => true,
            'msg' => 'Successfully updated info!',
        ]);
    }

    public function profileDelete(Request $request) {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                "msg" => "This action requires your password. Deleting your account is irreversible.",
            ],404);
        }
        //die(var_dump(!Hash::check($request->password, $user->password)));
        $user->delete();

        return response()->json([
            'success' => true,
            'msg' => 'Successfully deleted user.',
        ]);
    }

    public function show(Request $request, $id) {
        $user = User::find($id);
        if (!isset($user->id)) {
            return response()->json([
                'success' => false,
                "msg" => "This user does not exist!",
            ],404);
        }
        return response()->json([
            'success' => true,
            'msg' => 'Found user.',
            'data' => $user->makeHidden(['email_verified_at']),
        ]);
    }

    public function update(ProfileUpdateRequest $request, $id) {
        $user = User::find($id);
        if (!isset($user->id)) {
            return response()->json([
                "status" => 0,
                "msg" => "This user does not exist!",
            ],404);
        }
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();
        return response()->json([
            'status' => 1,
            'msg' => 'Successfully updated info!',
        ]);
    }

    public function destroy(Request $request, $id) {
        $admin = Auth::user();
        $user = User::find($id);
        if (!isset($user->id)) {
            return response()->json([
                "status" => 0,
                "msg" => "This user does not exist!",
            ],404);
        }
        if (!Hash::check($request->password, $admin->password)) {
            return response()->json([
                "status" => 0,
                "msg" => "This action requires your password. Deleting an account is an irreversible action.",
            ],404);
        }
        //die(var_dump(!Hash::check($request->password, $user->password)));
        $user->delete();
        return response()->json([
            'status' => 1,
            'msg' => 'Successfully deleted user.',
        ]);
    }
}
