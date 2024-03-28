<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function edit()
    {
        $userId = auth()->id(); // Obtiene el ID del usuario autenticado

        // Recupera la instancia del modelo User usando el ID
        $user = User::findOrFail($userId);
        // Obtiene el usuario autenticado
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $userId = auth()->id(); // Obtiene el ID del usuario autenticado

        // Mensajes de error personalizados
        $messages = [
            'email.unique' => 'Este correo electrónico ya está registrado. Por favor, utiliza otro.',
            // Aquí puedes añadir más mensajes personalizados para otras reglas de validación si es necesario
        ];

        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'phone' => 'nullable|regex:/^\+[0-9]+$/',
            'address' => 'nullable|string|max:255',
        ];

        // Ejecutar la validación
        $request->validate($rules, $messages);

        // Recupera la instancia del modelo User usando el ID y actualiza
        $user = User::findOrFail($userId);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('users.edit')->with('success', 'Perfil actualizado correctamente.');
    }


    public function showChangePasswordForm()
    {
        return view('admin.user.change_password');
    }

    public function changePassword(Request $request)
{
    // Mensajes de error personalizados
    $messages = [
        'current_password.required' => 'Debes proporcionar tu contraseña actual.',
        'new_password.required' => 'Por favor, introduce una nueva contraseña.',
        'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
        'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
    ];

    // Validación con mensajes personalizados
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|confirmed',
    ], $messages);

    $user = User::findOrFail(auth()->id());

    if (!Hash::check($request->current_password, $user->password)) {
        // La contraseña actual no coincide
        return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
    }

    // La contraseña actual coincide, proceder a cambiarla
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('user.password.change')->with('success', 'Contraseña cambiada correctamente.');

}


}
