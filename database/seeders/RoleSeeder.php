<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            'name' => 'superadmin'
        ]);
        Role::create([
            'name' => 'kadin'
        ]);
        Role::create([
            'name' => 'admin1'
        ]);
        Role::create([
            'name' => 'admin2'
        ]);
        Role::create([
            'name' => 'member'
        ]);
    }
}
