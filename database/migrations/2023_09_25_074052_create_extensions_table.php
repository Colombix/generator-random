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
            $table->string('extension', 40)->nullable()->index();
            $table->boolean('is_private')->default(false);
            $table->timestamps();

        });

        foreach ([
                     'net', 'org', 'io', 'fr','kg','ac','af','ag','md',
                 ] as $extension) {
            Extension::create([
                'extension' => $extension
            ]);
        }

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
