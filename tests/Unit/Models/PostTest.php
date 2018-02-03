<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Post;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_post_with_the_correct_properties()
    {
        $post = factory(Post::class)->make();

        $this->assertNotNull($post->conent);
        $this->assertNotNull($post->thread_id);
        $this->assertNotNull($post->user_id);
    }
}
