<?php

namespace Database\Seeders;

use App\Models\Pelayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1;$i<=24;$i++){
          Pelayanan::create([
            'id_subkategori' => $i,
            'image' => $i . '.jpeg',
            'url' => ''
          ]);
        }
    }
}
