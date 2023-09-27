<?php

use App\Models\Extension;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('extension', 40)->nullable();
            $table->boolean('is_private')->default(false);

        });

        Extension::create([
            'extension' => 'fr',

        ]);

        Extension::create([
            'extension' => 'com',
            'is_private' => true
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('extensions');
    }
};
