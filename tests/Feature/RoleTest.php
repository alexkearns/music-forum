<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\User;
use App\Thread;
use App\Post;

class RoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function cannot_access_the_manage_perms_page_without_the_correct_role()
    {   
        $user = factory(User::class)->create();
        $admin = factory(User::class)->create();

        $response = $this->actingAs($admin)
            ->post(route('manage-user-action', ['id' => $user->id, 'admin' => 'on']))
            ->assertStatus(403);
    }

    /** @test */
    public function can_change_the_perms_of_a_user()
    {   
        Bouncer::dontCache();

        $user = factory(User::class)->create();
        $admin = factory(User::class)->create();

        $manageUsers = Bouncer::ability()->create([
            'name' => 'manage-users',
            'title' => 'Manage users',
        ]);

        $assignAdmin = Bouncer::ability()->create([
            'name' => 'assign-admin',
            'title' => 'Assign admin',
        ]);

        $assignModerator = Bouncer::ability()->create([
            'name' => 'assign-moderator',
            'title' => 'Assign moderator',
        ]);

        Bouncer::allow($admin)->to($manageUsers);
        Bouncer::allow($admin)->to($assignAdmin);
        Bouncer::allow($admin)->to($assignModerator);

        $response = $this->actingAs($admin)
            ->post(route('manage-user-action', ['id' => $user->id, 'admin' => 'on']))
            ->assertStatus(302);

        $this->assertTrue(Bouncer::is($user)->an('admin'));

        $response = $this->actingAs($admin)
            ->post(route('manage-user-action', ['id' => $user->id, 'mod' => 'on']))
            ->assertStatus(302);

        $this->assertTrue(Bouncer::is($user)->a('moderator'));        
    }

    /** @test */
    public function can_ban_a_user()
    {   
        $user = factory(User::class)->create();
        $admin = factory(User::class)->create();

        $manageUsers = Bouncer::ability()->create([
            'name' => 'manage-users',
            'title' => 'Manage users',
        ]);

        $ban = Bouncer::ability()->create([
            'name' => 'ban-user',
            'title' => 'Ban user',
        ]);

        Bouncer::allow($admin)->to($manageUsers);
        Bouncer::allow($admin)->to($ban);

        $response = $this->actingAs($admin)
            ->post(route('manage-user-action', ['id' => $user->id, 'ban' => 'on']))
            ->assertStatus(302);

        // $this->assertTrue($user->banned);
    }

    /** @test */
    public function cannot_delete_a_post_when_not_allowed()
    {	
    	$notAllowedUser = factory(User::class)->create();
        $postUser = factory(User::class)->create();
        $thread = factory(Thread::class)->create();
        $post = factory(Post::class)->create([
        	'user_id' => $postUser->id,
        ]);

        $response = $this->actingAs($notAllowedUser)
            ->get(route('deletePost', ['post' => $post->id]))
            ->assertStatus(302);

        // Post wont be deleted.
        $this->assertDatabaseHas('posts', [
        	'id' => $post->id
        ]);
    }

    /** @test */
    public function can_delete_a_post_when_allowed()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();
        $post = factory(Post::class)->create();

        $deleteAnyPost = Bouncer::ability()->create([
            'name' => 'delete-any-post',
            'title' => 'Delete any post',
        ]);
        
        Bouncer::allow($user)->to($deleteAnyPost);
        
        $response = $this->actingAs($user)
            ->get(route('deletePost', ['post' => $post->id]))
            ->assertStatus(302);
        
        $this->assertDatabaseMissing('posts', [
        	'id' => $post->id
        ]);
    }

    /** @test */
    public function can_delete_a_thread_when_allowed()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();
        
        $deleteAnyThread = Bouncer::ability()->create([
            'name' => 'delete-any-thread',
            'title' => 'Delete any thread',
        ]);
        
        Bouncer::allow($user)->to($deleteAnyThread);
        
        $response = $this->actingAs($user)
            ->get(route('deleteThread', ['thread' => $thread->id]))
            ->assertStatus(302);

        $this->assertDatabaseMissing('threads', [
        	'id' => $thread->id
        ]);
    }

    /** @test */
    public function cannot_delete_a_thread_when_not_allowed()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create();
        $post = factory(Post::class)->create([
        	'thread_id' => $thread->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('deleteThread', ['thread' => $thread->id]))
            ->assertStatus(302);

        // Thread wont be deleted.
        $this->assertDatabaseHas('threads', [
        	'id' => $thread->id
        ]);
    }
}
