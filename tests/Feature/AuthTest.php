<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_access_when_authenticated()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get('/home');

        $response->assertStatus(200);
    }

    /** @test */
    public function cannot_access_when_not_authenticated()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }
}
