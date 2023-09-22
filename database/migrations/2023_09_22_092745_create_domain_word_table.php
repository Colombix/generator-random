<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('domain_word', function (Blueprint $table) {
            $table->string('status', 255)->default('waiting');
            $table->foreignId('domain_id')->constrained('domains')->onDelete('cascade');
            $table->foreignId('word_id')->constrained('words')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('domain_word');
    }
};
