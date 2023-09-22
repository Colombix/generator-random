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

        // améliorer le code crée plusieur permissions , crée un autre tableau pour faire un foreach sur mes permissions create

        $adminRole = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'viewAny']);

        $adminRole->givePermissionTo(['viewAny']);
        $user->givePermissionTo(['viewAny']);


    }

    public function down(): void
    {
        Schema::dropIfExists('role_tables');
    }
};
