<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            'view',
            'create',
            'edit',
            'delete',
            'manage_users',
            'manage_roles',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

         // Crear roles y asignar permisos
        $roleDeveloper = Role::create(['name' => 'desarrollador']);
        $roleDeveloper->givePermissionTo(Permission::all());

        $roleManager = Role::create(['name' => 'gerente']);
        $roleManager->givePermissionTo(['view', 'create', 'edit']);

        $roleHR = Role::create(['name' => 'talentoHumano']);
        $roleHR->givePermissionTo(['view', 'create', 'edit']);

        $roleCommercial = Role::create(['name' => 'comercial']);
        $roleCommercial->givePermissionTo(['view', 'create']);

        $roleUser = Role::create(['name' => 'user']);
        $roleUser->givePermissionTo('view');
    }
}
