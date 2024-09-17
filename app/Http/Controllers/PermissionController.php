<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        return view('users.permisos', compact('permisos'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        return redirect()->back()->with('success', 'permiso creado con extito');
    }

    public function asignar()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'name' => $route->getName(),
            ];
        });

        $permissions = Permission::all();

        return view('permissions.asignar', compact('routes', 'permissions'));
    }

    public function assignPermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|string',
            'type' => 'required|in:give,revoke',
        ]);

        $user = User::findOrFail($request->user_id);
        $permission = Permission::findOrCreate($request->permission);

        if ($request->type === 'give') {
            $user->givePermissionTo($permission);
            return response()->json(['message' => 'Permiso asignado correctamente']);
        } else {
            $user->revokePermissionTo($permission);
            return response()->json(['message' => 'Permiso revocado correctamente']);
        }
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'permiso actualizado con extito');;
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        return redirect()->back()->with('success', 'permiso eliminado con extito');;
    }
}
