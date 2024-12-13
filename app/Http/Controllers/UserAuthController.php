<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Helpers\ApiResponse;
use Exception;

class UserAuthController extends Controller
{
    //

    // function signup(Request $request) {
    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //     $success['name'] =  $user->name;
    //     return ['status' => 'success', 'data' => $success, "msg" => "User register successfully."];
    // }

    /**
     * Handle user signup.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function signup(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);

    //     $validated['password'] = bcrypt($validated['password']);
    //     $user = User::create($validated);

    //     $token = $user->createToken('MyApp')->plainTextToken;

    //     return ApiResponse::success([
    //         'token' => $token,
    //         'name' => $user->name,
    //     ], 'User registered successfully.');
    // }

        public function signup(Request $request)
        {
            try {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                ]);

                $validated['password'] = bcrypt($validated['password']);
                $user = User::create($validated);

                $token = $user->createToken('MyApp')->plainTextToken;

                return ApiResponse::success([
                    'token' => $token,
                    'name' => $user->name,
                ], 'User registered successfully.');
            } catch (Exception $e) {
                return ApiResponse::error(null, 'An error occurred during signup: ' . $e->getMessage(), 500);
            }
        }

    // function login(Request $request)
    // {
    //     $user = User::where('email', $request['email'])->first();
    //     if(!$user || !Hash::check($request['password'], $user->password)) {
    //         return ["status" => "error", "message" => "Invalid email or password"];
    //     }
    //     $token = $user->createToken('MyApp')->plainTextToken;
    //     $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //     $success['name'] =  $user->name;
    //     return ['status' => 'success', 'data' => $success, "msg" => "User register successfully."];
        
    // }

     /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $validated['email'])->first();

    //     if (!$user || !Hash::check($validated['password'], $user->password)) {
    //         return ApiResponse::error(null, 'Invalid email or password', 401);
    //     }

    //     $token = $user->createToken('MyApp')->plainTextToken;

    //     return ApiResponse::success([
    //         'token' => $token,
    //         'name' => $user->name,
    //     ], 'Login successful.');
    // }
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return ApiResponse::error(null, 'Invalid email or password', 401);
            }

            $token = $user->createToken('MyApp')->plainTextToken;

            return ApiResponse::success([
                'token' => $token,
                'name' => $user->name,
            ], 'Login successful.');
        } catch (Exception $e) {
            return ApiResponse::error(null, 'An error occurred during login: ' . $e->getMessage(), 500);
        }
    }

        /**
     * Handle user logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function logout()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return ApiResponse::error(null, 'User not authenticated', 401);
            }

            // Revoke all tokens for the authenticated user
            $user->tokens()->delete();

            return ApiResponse::success(null, 'Logout successful.');
        } catch (Exception $e) {
            return ApiResponse::error(null, 'An error occurred during logout: ' . $e->getMessage(), 500);
        }
    }
}
