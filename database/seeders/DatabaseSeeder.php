<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    \App\Models\User::create([
      'id_role' => 1,
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);
    \App\Models\User::create([
      'id_role' => 2,
      'name' => 'kadin',
      'email' => 'kadin@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);
    \App\Models\User::create([
      'id_role' => 2,
      'name' => 'Sekretaris 1',
      'email' => 'sekretaris1@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);
    \App\Models\User::create([
      'id_role' => 3,
      'name' => 'PPSKS',
      'email' => 'ppsks@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);
    \App\Models\User::create([
      'id_role' => 4,
      'name' => 'PPMKS',
      'email' => 'ppmks@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);
    \App\Models\User::create([
      'id_role' => 5,
      'name' => 'member',
      'email' => 'member@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);
    \App\Models\User::create([
      'id_role' => 6,
      'name' => 'Sekretaris 2',
      'email' => 'sekretaris2@gmail.com',
      'password' => Hash::make('12345678'),
      'is_active' => true,
    ]);

    $this->call([
      UserSeeder::class,
      RoleSeeder::class,
      StatusSeeder::class,
      KategoriSeeder::class,
      SubkategoriSeeder::class,
      CarouselSeeder::class,
      PelayananSeeder::class,
    ]);
  }
}
