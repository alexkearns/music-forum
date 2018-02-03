<?php

namespace Tests\Unit;

use App\Post;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_post_with_the_correct_properties()
    {
        $post = factory(Post::class)->make();

        $this->assertNotNull($post->content);
        $this->assertNotNull($post->thread_id);
        $this->assertNotNull($post->user_id);
    }

    /** @test */
    public function can_get_the_user_and_thread_for_a_post()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();
        $post = factory(Post::class)->create([
            'thread_id' => $thread->id,
            'user_id' => $user->id
        ]);

        $this->assertEquals($post->getUser()->id, $user->id);
        $this->assertEquals($post->getThread()->id, $thread->id);
    }
}
