<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table
        for($i = 1; $i < 100; $i++){
            Category::create([
                'name'  => 'Buku Laravel '.$i,
                'slug'  => Str::slug('Buku Laravel '.$i)
            ]);
        }
    }
}
