<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('configs')->insert([
                                         'title'      => 'Blogger',
                                         'github'     => 'https://github.com/dervistprk',
                                         'linkedin'   => 'https://www.linkedin.com/in/dervi%C5%9F-toprak-0698a81b7/',
                                         'created_at' => now(),
                                         'updated_at' => now(),
                                     ]);

    }
}
