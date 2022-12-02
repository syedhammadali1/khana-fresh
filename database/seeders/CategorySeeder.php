<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::insert('categories', [
        ['name' => 'MEAT BASED'],
        ['name' => 'MIX'],
        ['name' => 'PLANT'],
       ]);

    }
}
