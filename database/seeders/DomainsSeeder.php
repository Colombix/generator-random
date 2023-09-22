<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainsSeeder extends Seeder
{

    public function run(): void
    {

        // pourrait $etre mit dans la migration
        Domain::create([
            'extension' => 'fr',
        ]);

        Domain::create([
            'extension' => 'com'
        ]);
    }
}
