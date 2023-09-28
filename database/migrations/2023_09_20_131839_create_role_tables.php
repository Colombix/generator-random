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


        Permission::create(['name' => 'view extension']);
        Permission::create(['name' => 'view public extensions']);

        $userRole->givePermissionTo('view public extensions');
        $adminRole->givePermissionTo('view public extensions');

        $adminRole->givePermissionTo('view extension');


    }

    public function down(): void
    {
        Schema::dropIfExists('role_tables');

    }
};
