<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {

            // extension limité le nombre de caractère 30 à 40 caractère
            $table->id();
            $table->timestamps();
            $table->string('extension');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
