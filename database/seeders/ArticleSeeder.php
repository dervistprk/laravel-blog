<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faker = Faker::create();
        for($i = 0; $i < 8; $i++){
            $title     = $faker->sentence(6);
            $sub_title = $faker->sentence(20);
            DB::table('articles')->insert([
                                              'category_id' => rand(1, 6),
                                              'title'       => $title,
                                              'sub_title'   => $sub_title,
                                              'image'       => $faker->imageUrl(800, 400, 'cats', 'Blogger'),
                                              'content'     => $faker->paragraph(15),
                                              'slug'        => str_slug($title),
                                              'created_at'  => $faker->dateTime(),
                                              'updated_at'  => now(),
                                          ]);
        }
    }
}
