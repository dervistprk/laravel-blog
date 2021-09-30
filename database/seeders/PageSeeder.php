<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $pages  = ['Hakkımızda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $count  = 0;
        foreach($pages as $page){
            DB::table('pages')->insert([
                                           'title'      => $page,
                                           'content'    => 'Omnis assumenda error ipsam qui sed harum sunt quia. Consectetur eius voluptatem aut exercitationem vitae aut.
                                                            Aut vel consequuntur quia cupiditate nisi dolor. Aut assumenda voluptatem rem voluptatem et minima. Ut adipisci tenetur corporis et.
                                                            Quos fugiat vel qui provident. Sunt quidem ab omnis mollitia sequi et autem. Accusamus ut itaque officiis sit dolores minima eaque.
                                                            Commodi laborum necessitatibus quo provident.',
                                           'image'      => 'https://industrytoday.com/wp-content/uploads/2018/12/business-3224643_1920.jpg',
                                           'order'      => $count++,
                                           'slug'       => Str::slug($page),
                                           'created_at' => now(),
                                           'updated_at' => now(),
                                       ]);
        }
    }
}
