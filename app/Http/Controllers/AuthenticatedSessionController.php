<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        // Validation logic
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->is_active == 0) {
            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact support.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['name' => Auth::user()->name]); // Store name in session

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function checkemail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json([
                'exists' => true,
                'role' => $user->role
            ]);
        }

        return response()->json(['exists' => false]);
    }

    public function resetPassword(Request $request)
    {
        $email = $request->input('email');
        $newPassword = $request->input('newPassword');
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
