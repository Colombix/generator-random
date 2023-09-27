<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration {

    public function up(): void
    {

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);


        Permission::create(['name' => 'view domains']);
        Permission::create(['name' => 'view private extension']);

        $userRole->givePermissionTo('view domains');
        $adminRole->givePermissionTo('view domains');

        $adminRole->givePermissionTo('view private extension');


    }

    public function down(): void
    {
        Schema::dropIfExists('role_tables');

    }
};
