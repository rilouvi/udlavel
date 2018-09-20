<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->truncate();

        $posts=[];
        $acak = Factory::create();
        $tanggal = Carbon::create(2018, 9, 8, 12,15,24);

        for($i=1; $i<=10; $i++){
            $image="Post_Image_".rand(1, 5) . ".jpg";
            
            // $date=date("Y-m-d H:i:s", strtotime("2018-03-21 12:15:24 +{$i} days"));
            $tanggal=$tanggal->addDays($i);
            $publishedDate = clone($tanggal);
            $createDate = clone($tanggal);
            $posts[]=[
                'author_id'=>rand(1,3),
                'title'=>$acak->sentence(rand(8, 12)),
                'excerpt'=>$acak->text(rand(250, 300)),
                'body'=>$acak->paragraphs(rand(10,15), true),
                'slug'=>$acak->slug(),
                'images'=>rand(0,1) == 1 ? $image : NULL,
                'created_at'=>$createDate,
                'updated_at'=>$createDate,
                'category_id'=>rand(1,5),
                // 'published_at'=>$i > 5 && rand(1,0)==0 ? NULL : $publishedDate->addDays($i + rand(0,3)),
                'published_at'=>$i < 5 ? $publishedDate : (rand(0,1)==0 ? NULL : $publishedDate->addDays(4)),
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
