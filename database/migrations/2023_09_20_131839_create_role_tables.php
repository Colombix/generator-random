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
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'viewAny']);

        Permission::create(['name' => 'delete']);

        $adminRole->givePermissionTo(['viewAny', 'delete']);
        $user->givePermissionTo(['viewAny']);


    }

    public function down(): void
    {
        Schema::dropIfExists('role_tables');
    }
};
