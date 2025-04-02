<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Login extends Controller
{
    public function signupreturn(){
        // This method returns the view for the signup page
        return view('signUp');
    }

    public function showLogin()
    {
        // This method returns the view for the login page
        return view('Login'); 
    }

    public function store(Request $request)
{
    // Validar los datos enviados desde el formulario
    $validatedData = $request->validate([
        'name' => 'required|string|max:200',
        'username' => 'required|string|max:200|unique:usuario',
        'password' => 'required|string|min:8|max:200',
    ]);

    // Crear un nuevo usuario en la base de datos
    $user = User::create([
        'name' => $validatedData['name'],
        'username' => $validatedData['username'],
        'password' => Hash::make($validatedData['password']), // Hashear la contraseña
    ]);

    // Redirigir al login con un mensaje de éxito
    return redirect()->route('signup')->with('success', 'Usuario registrado exitosamente.');
}

public function iniciosesion(Request $request)
{
    // Validar los datos enviados desde el formulario
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Intentar autenticar al usuario
    if (Auth::attempt($credentials)) {
        // Regenerar la sesión para evitar fijación de sesión
        $request->session()->regenerate();

        // Redirigir al usuario a la página de inicio
        return redirect()->route('home');
    }

    // Si la autenticación falla, redirigir de vuelta con un mensaje de error
    return redirect()->route('login')->with('error', 'Usuario y/o contrasena incorrectos.');
}
}
