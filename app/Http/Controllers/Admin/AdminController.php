<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\info_state;
use App\Models\info_city;
use App\Models\info_parishes;
use App\Models\Domain;
use App\Models\User;
use App\Models\Role;


use App\Models\Benefit;
use App\Models\Multimedia;
use App\Models\laundry_types;
use App\Models\Type_Benefit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function list_users(Request $request)
    {
        $users = User::paginate(30); // Modifica según necesites para la carga inicial
        $roles = Role::all(); // Obtener todos los roles para el selector

        return view('admin.userAdmin.list_users', compact('users', 'roles'));
    }
    public function ajaxListUsers(Request $request)
{
    $query = User::query();

    // Filtros de búsqueda
    if ($request->filled('query')) {
        $searchTerm = $request->query;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%')
              ->orWhere('email', 'like', '%' . $searchTerm . '%')
              ->orWhere('phone', 'like', '%' . $searchTerm . '%');
        });
    }

    if ($request->filled('role')) {
        $query->where('role_id', $request->role);
    }

    if ($request->filled('status')) {
        $query->where('is_active', $request->status);
    }

    $users = $query->paginate(30); // Ajusta la paginación como necesites

    return view('admin.userAdmin.partials_users_table', compact('users'))->render();
}
    public function updateRole(Request $request, User $user)
    {
        try {
            $user->update(['role_id' => $request->role_id]);
            $roleName = $user->role->name; // Asegúrate de tener una relación 'role' en tu modelo User
            $message = "El rol de {$user->name} ha sido actualizado a {$roleName} con éxito.";
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar el rol del usuario: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => "Hubo un error al intentar actualizar el rol de {$user->name}."], 500);
        }
    }

    public function updateIsActive(Request $request, User $user)
    {
        try {
            $user->update(['is_active' => $request->is_active]);
            $isActive = $user->is_active ? 'activo' : 'inactivo';
            $message = "El estado de {$user->name} ha sido actualizado a {$isActive} con éxito.";
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar el estado del usuario: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => "Hubo un error al intentar actualizar el estado de {$user->name}."], 500);
        }
    }


    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        try {
            $messages = [
                'email.unique' => 'Este correo electrónico ya está registrado. Por favor, utiliza otro.',
                'phone.regex' => 'El número de teléfono tiene un formato inválido.',
                'name.regex' => 'El nombre y apellido es necesario.',
                // Aquí puedes añadir más mensajes personalizados para otras reglas de validación si es necesario
            ];
    
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'nullable|regex:/^\+?[0-9]+$/',
                'address' => 'nullable|string|max:255',
                // Añade aquí las validaciones para otros campos que desees actualizar
            ],$messages);
            
            $user->update($data);
    
            return response()->json(['success' => true, 'message' => "Información de {$user->name} actualizada con éxito."]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error al actualizar la información. Error: {$e->getMessage()}"], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $userName = $user->name; // Guardar el nombre para usarlo en la respuesta
            $user->delete();
            return response()->json(['success' => true, 'message' => "El usuario {$userName} ha sido eliminado con éxito."]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error al intentar eliminar el usuario."], 500);
        }
    }

    public function list_services(Request $request)
    {
        $benefits = Benefit::with('typeBenefit')->paginate(20); // Asumiendo relación 'typeBenefit'
        $typeBenefits= Type_Benefit::All();

        return view('admin.userAdmin.list_services', compact('benefits','typeBenefits'));
    }

    public function createService(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type_benefit_id' => 'required|exists:type_benefits,id',
        ]);
    
        $service = new Benefit($validatedData);
        $service->save();
    
        return response()->json(['success' => true, 'message' => 'Servicio creado exitosamente.']);
    }

    public function editService(Benefit $service)
    {
        return response()->json($service->load('typeBenefit')); // Asegúrate de cargar relaciones si es necesario
    }

    public function updateService(Request $request, Benefit $service)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type_benefit_id' => 'required|exists:type_benefits,id',
            ]);
            
            $service->update($validatedData);

            return response()->json(['success' => true, 'message' => 'Servicio actualizado exitosamente.']);
        } catch (\Exception $e) {
            // Registra el error y la solicitud que lo causó
            Log::error('Error actualizando servicio: '.$e->getMessage(), $request->all());
            
            return response()->json(['success' => false, 'message' => 'Error al actualizar el servicio.'], 500);
        }
    }

    public function destroyService(Benefit $service)
    {
        try {
            $serviceName = $service->name; // Guardar el nombre para usarlo en la respuesta
            $service->delete();
            return response()->json(['success' => true, 'message' => "El servicio {$serviceName} ha sido eliminado con éxito."]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error al intentar eliminar el servicio."], 500);
        }
    }
    public function createTypeService(Request $request)
    {
        Log::info('Llege: ');
        // Validar la entrada del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:type_benefits,name',
        ]);

        try {
            // Crear el nuevo TypeService
            $typeService = new Type_Benefit();
            $typeService->name = $validatedData['name'];
            $typeService->save();

            // Opcionalmente, puedes devolver una respuesta más detallada
            // o incluso redirigir al usuario a una página específica
            return response()->json([
                'success' => true, 
                'message' => 'Tipo de servicio creado exitosamente.',
                'data' => $typeService
            ]);
        } catch (\Exception $e) {
            Log::error('Error creando tipo de servicio: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de servicio. Por favor, intente nuevamente.',
            ], 500);
        }
    }

}
