<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomRole;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('auth.register');
    }

    // Método para almacenar el nuevo usuario
    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Crear un equipo personal para el nuevo usuario, si es necesario
        if (config('jetstream.features.teams')) {
            Log::info('Jetstream está habilitado. Intentando crear un equipo...');
    
            try {
                $team = Team::create([
                    'user_id' => $user->id,
                    'name' => $request->name . "'s Team",
                    'personal_team' => true,
                ]);
    
                // Asignar el equipo al usuario
                $user->current_team_id = $team->id;
                $user->save();
    
                Log::info('Equipo creado con éxito: ' . $team->id);
            } catch (\Exception $e) {
                Log::error('Error al crear el equipo: ' . $e->getMessage());
            }
        } else {
            Log::info('Jetstream no está habilitado.');
        }

        
        

        // Redirigir al usuario a la página de inicio o a donde desees
        return redirect()->route('home')->with('status', 'Usuario registrado con éxito.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $roleUsers = $user->roles->pluck('id')->toArray();

        return view('users.rolesUser', compact('user', 'roles', 'roleUsers'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rolesId = $request->input('roles', []);

        $roles = Role::wherein('id', $rolesId)->pluck('name')->toArray();
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'El role se ha asignado correctamente');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Usuario eliminado con éxito.');
    }

}
