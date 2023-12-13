<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller {

    public function getUserByID(Request $request) {
        $id = $request->query('id');
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['success' => false, 'error' => `User with the id: '` + $id + `' was not found.`], 404);
        }
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function getUserByEmail(Request $request) {
        try {
            $email = $request->query('email');
            $user = User::where('email', $email)->first();
            if (!$user) {
                return response()->json(['success' => false, 'error' => `User with the email: '` + $email + `' was not found.`], 404);
            }
            return response()->json(['success' => true, 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    // REGISTER METHOD
    public function register(Request $request) {
        try {
            $request->validate([
                'birthDate' => 'required',
                'password' => 'required|min:8',
                'phone' => 'required|min:4|max:13',
                'lastName' => 'required|min:4|max:120',
                'firstName' => 'required|min:4|max:120',
                'userName' => 'required|min:8|max:100|unique:users',
                'email' => 'required|email|min:5|max:80|unique:users',
            ]);
            $hashedPassword = bcrypt($request->input('password'));
            $user = User::create([
                'password' => $hashedPassword,
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'lastName' => $request->input('lastName'),
                'userName' => $request->input('userName'),
                'birthDate' => $request->input('birthDate'),
                'firstName' => $request->input('firstName'),
            ]);
            return response()->json(['success' => true, 'user' => $user]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    // LOGIN METHOD
    public function login(Request $request) {
        try {
            $request->validate([
                'password' => 'required|min:4',
                'email' => 'required|email|min:5|max:80|',
            ]);
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                return response()->json(['success' => false, 'error' => 'Invalid email or password'], 500);
            }
            if (password_verify($request->input('password'), $user->password)) {
                return response()->json(['success' => true, 'user' => $user]);
            } else {
                return response()->json(['success' => false, 'error' => 'Invalid email or password'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
