<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        }
        return view('login.index');
    }

    public function authenticate($token) {
        // $token is the full plainTextToken, which is in the format: token_id|token_string
        [$tokenId, $tokenString] = explode('|', $token, 2);

        // Find the token in the database
        $personalAccessToken = \Laravel\Sanctum\PersonalAccessToken::find($tokenId);

        if ($personalAccessToken && hash_equals($personalAccessToken->token, hash('sha256', $tokenString))) {
            // Authenticate the user
            auth()->loginUsingId($personalAccessToken->tokenable_id);

            // Authentication passed
            if (auth()->user()->hasRole('admin')) {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('product');
            }
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');
    }

}