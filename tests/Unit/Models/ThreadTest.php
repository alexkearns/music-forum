<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;
use App\Thread;
use App\Post;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_thread_with_the_correct_properties()
    {
        $thread = factory(Thread::class)->make();

        $this->assertNotNull($thread->title);
        $this->assertNotNull($thread->user_id);
    }

    /** @test */
    public function can_get_the_posts_for_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $posts = factory(Post::class, 5)->create([
            'thread_id' => $thread->id,
        ]);

       	$this->assertEquals($thread->getPosts()->count(), 5);
    }

    /** @test */
    public function can_get_the_most_recent_post()
    {
        $thread = factory(Thread::class)->create();
        $oldPost = factory(Post::class)->create([
            'thread_id' => $thread->id,
            'created_at' => Carbon::now(),
        ]);

        $newPost = factory(Post::class)->create([
            'thread_id' => $thread->id,
            'created_at' => Carbon::now()->addSeconds(2), // Creates both results at same time otherwise
        ]);

       	$this->assertEquals($thread->getRecentPost()->id, $newPost->id);
    }
}
