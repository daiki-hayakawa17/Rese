<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'name' => 'Aコース',
                'price' => '1500',
            ],
            [
                'name' => 'Bコース',
                'price' => '2000',
            ],
            [
                'name' => 'Cコース',
                'price' => '3000',
            ],
        ]);
    }
}
