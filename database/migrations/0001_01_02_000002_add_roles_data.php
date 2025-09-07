<?php

use App\Libraries\PermissionRoleLib;
use Illuminate\Database\Migrations\Migration;

class AddRolesData extends Migration
{
    public function up()
    {
        PermissionRoleLib::resetPermissionsCache();

        echo "Adding roles data...\n";
        PermissionRoleLib::addRole('developer');
        echo "Added: developer \n";
        PermissionRoleLib::addRole('admin');
        echo "Added: admin \n";
        PermissionRoleLib::addRole('bookkeeper');
        echo "Added: bookkeeper \n";
        PermissionRoleLib::addRole('account_manager');
        echo "Added: account_manager \n";
        PermissionRoleLib::addRole('factory');
        echo "Added: factory \n";
        PermissionRoleLib::addRole('customer');
        echo "Added: customer \n";
    }

    public function down()
    {
        PermissionRoleLib::deleteAllRoles();
    }
}
