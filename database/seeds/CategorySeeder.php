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

        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Процессоры',
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Видеокарты',
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Материнские платы',
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Компьютерные комплектующие',
        ]);
    }
}
