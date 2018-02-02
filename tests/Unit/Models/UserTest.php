<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

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
}
