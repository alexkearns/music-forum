<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Thread;
use App\Post;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_user_with_the_correct_properties()
    {
        $user = factory(User::class)->make();

        $this->assertNotNull($user->email);
        $this->assertNotNull($user->name);
        $this->assertNotNull($user->password);
    }

    /** @test */
    public function can_get_the_threads_and_posts_for_a_user()
    {
        $user = factory(User::class)->create();
        $threads = factory(Thread::class, 5)->create([
            'user_id' => $user->id,
        ]);
        $posts = factory(Post::class, 5)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->threads->count(), 5);
        $this->assertEquals($user->posts->count(), 5);
    }
}
