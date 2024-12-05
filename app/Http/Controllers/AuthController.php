<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function login(Request $request)
{
    $request->validate([
        'employee_id' => 'required',
        'password' => 'required',
    ]);

    // Retrieve the officer by employee_id
    $officer = Officer::where('employee_id', $request->employee_id)->first();

    if (!$officer || !Hash::check($request->password, $officer->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Delete all existing tokens for this officer
    $officer->tokens()->delete();

    // Generate a new token for the officer
    $token = $officer->createToken('officer-auth-token')->plainTextToken;

    // Return response based on is_admin value
    if ($officer->is_admin == 1) {
        return response()->json([
            'message' => 'Login successful (Admin)',
            'token' => $token,
            'officer' => $officer,
            'is_admin' => true,
        ]);
    } else {
        return response()->json([
            'message' => 'Login successful (User)',
            'token' => $token,
            'officer' => $officer,
            'is_admin' => false,
        ]);
    }
}


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
