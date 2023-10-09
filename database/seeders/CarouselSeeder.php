<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Carousel::create([
            'url' => '1.jpeg'
        ]);
        Carousel::create([
            'url' => '2.jpeg'
        ]);
        Carousel::create([
            'url' => '3.jpeg'
        ]);
    }
}
