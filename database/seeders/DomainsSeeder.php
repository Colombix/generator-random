<?php

namespace Database\Seeders;

use App\Models\Extension;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainsSeeder extends Seeder
{

    public function run(): void
    {
        // TODO pourrait être mit dans la migration
        Extension::create([
            'extension' => 'fr',
        ]);

        Extension::create([
            'extension' => 'com'
        ]);
    }
}
