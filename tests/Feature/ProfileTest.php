<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        factory(User::class)->create();
    }

    /** @test */
    public function can_see_a_profiles_summary()
    {
        $user = factory(User::class)->create();
        $profile = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('profile', $profile))
            ->assertStatus(200)
            ->assertSee($profile->name)
            ->assertSee($profile->role());
    }
}
