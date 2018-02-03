<?php

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
        factory(App\Post::class, 1)->create([
            'content' => '10/10 amazing',
            'thread_id' => 1,
            'user_id' => 2,
        ]);

        factory(App\Post::class, 1)->create([
            'content' => 'Sean Paul',
            'thread_id' => 2,
            'user_id' => 3,
        ]);

        factory(App\Post::class, 1)->create([
            'content' => 'Like Glue',
            'thread_id' => 3,
            'user_id' => 1,
        ]);
    }
}
