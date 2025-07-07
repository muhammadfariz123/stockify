<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    // app/Http/Controllers/Auth/RegisterController.php
    public function register(Request $request)
    {
        // Validasi data
        $this->validator($request->all())->validate();

        // Menampilkan data yang dikirim melalui request untuk memastikan role
        dd($request->all()); // Periksa apakah 'role' ada di sini dengan nilai yang benar

        // Menyimpan data pengguna baru
        $user = $this->create($request->all());

        // Melakukan login otomatis setelah registrasi
        auth()->login($user);

        // Redirect setelah registrasi sukses
        return redirect($this->redirectPath());
    }


    /**
     * Get the post registration redirection path.
     *
     * @return string
     */
    protected function redirectPath()
    {
        return route('dashboard'); // Bisa disesuaikan, tergantung tujuan setelah login
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:Admin,Manajer Gudang,Staff Gudang'], // Validasi role
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // Menyimpan role yang dipilih dari form registrasi
        ]);
    }
}
