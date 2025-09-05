<?php

namespace App\Libraries;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Methods to help reduce redundant code within /database/migrations
 */
class PermissionRoleLib
{
    /**
     * Create a permission and assign to existing Roles.
     * uses Spatie\Permission\Models\Permission; Spatie\Permission\Models\Role;
     *
     * @param string $permission e.g. 'edit links'
     * @param array  $roleNames  e.g. ['admin', 'manager']
     * @return void
     */
    static public function createAndAssignPermissionTo(string $permission, array $roleNames): void
    {
        Permission::createOrFirst(['name' => $permission]);

        // Reset cached roles and permissions
        static::resetPermissionsCache();

        foreach($roleNames as $roleName) {
            $roleAdmin = Role::findByName($roleName);
            $roleAdmin->givePermissionTo($permission);
        }
    }

    /**
     * This is to undo what was done by function createAndAssignPermissionTo()
     * Used when rolling back a migration.
     * !Note: !If Exists! Avoids errors by checking if the permission exists before deleting.
     *
     * @param string $permission
     * @param array  $roleNames
     * @return void
     */
    static public function revokeAndDeletePermissionTo(string $permission, array $roleNames): void
    {
        // Reset cached roles and permissions
        static::resetPermissionsCache();

        foreach($roleNames as $roleName) {
            $role = Role::findByName($roleName);
            $role->revokePermissionTo($permission);
        }

        $permission = Permission::where(['name' => $permission])->limit(1)->get();
        if($permission->isNotEmpty()) {
            $permission->first()->delete();
        }
    }

    static function addRole(string $roleName, ?string $guardName = null): void
    {
        // Reset cached roles and permissions
        static::resetPermissionsCache();

        Role::findOrCreate($roleName, $guardName = null);
    }

    static function resetPermissionsCache()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /**
     * Remove Roles from ALL Permissions!
     */
    static function removeRolesFromAllPermissions(): void
    {
        Permission::all()->each(function($permission) {
            $permission->roles()->detach();
        });
    }

    /**
     * Delete all Roles!
     */
    static function deleteAllRoles(): void
    {
        Role::all()->each(function($role) {
            $role->forceDelete();
        });
    }

    /**
     * Delete all Permissions!
     */
    static function deleteAllPermissions(): void
    {
        Permission::all()->each(function($permission) {
            $permission->forceDelete();
        });
    }
}
