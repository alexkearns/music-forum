<?php

use Illuminate\Database\Seeder;

class ThreadsAndPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	factory(App\Thread::class, 50)->create();
    	factory(App\Post::class, 200)->create();
    }
}
