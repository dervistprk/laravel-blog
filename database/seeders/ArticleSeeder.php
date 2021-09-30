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
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<8; $i++){
            $title = $faker->sentence(6);
            DB::table('articles')->insert([
                'category_id' => rand(1, 6),
                'title'       => $title,
                'image'       => $faker->imageUrl(800, 400, 'fashion', 'Blogger'),
                'content'     => $faker->paragraph(8),
                'slug'        => str_slug($title),
                'created_at'  => $faker->dateTime('now'),
                'updated_at'  => now(),
                                          ]);
        }
    }
}
