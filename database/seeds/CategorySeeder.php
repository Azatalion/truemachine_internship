<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $codeName = $faker->word();

        DB::table('categories')->insert([
            'id' => Category::max('id') + 1,
            'name' => $codeName,
            'code' => $codeName,
        ]);
    }
}
