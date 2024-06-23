<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = array(
            array(
                'title' => 'Post 1',
                'content' => 'Lorem 1',
                'category_id' => 1,
                'featured' => 'uploads/posts/1719155185.png',
                'slug' => str_slug('Post 1'),
                'user_id' => 1
            ),
            array(
                'title' => 'Post 2',
                'content' => 'Lorem 1',
                'category_id' => 2,
                'featured' => 'uploads/posts/1719155185.png',
                'slug' => str_slug('Post 2'),
                'user_id' => 1
            ),
            array(
                'title' => 'Post 3',
                'content' => 'Lorem 1',
                'category_id' => 3,
                'featured' => 'uploads/posts/1719155185.png',
                'slug' => str_slug('Post 3'),
                'user_id' => 1
            )
        );    
        foreach($posts as $value) {
            Post::create($value);
        }
    }
}
