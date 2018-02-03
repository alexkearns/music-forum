<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Thread;

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
}
