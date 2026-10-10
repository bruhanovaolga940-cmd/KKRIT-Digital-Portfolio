<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Сбрасываем кэш прав перед созданием
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'works.create', 'works.edit_own', 'works.delete_own', 'works.moderate',
            'certificates.manage',
            'jobs.view', 'jobs.create', 'jobs.manage_own',
            'applications.create', 'applications.review',
            'students.view',
            'users.view', 'users.block',
            'analytics.view',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $company = Role::firstOrCreate(['name' => 'company', 'guard_name' => 'web']);
        $moderator = Role::firstOrCreate(['name' => 'moderator', 'guard_name' => 'web']);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $student->syncPermissions([
            'works.create', 'works.edit_own', 'works.delete_own',
            'certificates.manage',
            'jobs.view', 'applications.create',
        ]);

        $company->syncPermissions([
            'jobs.view', 'jobs.create', 'jobs.manage_own',
            'applications.review', 'students.view',
        ]);

        $moderator->syncPermissions([
            'works.moderate',
            'jobs.view', 'users.view','students.view',
        ]);

        // Администратор получает все права
        $admin->syncPermissions(Permission::all());
    }
}