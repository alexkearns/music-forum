<?php

use App\User;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Database\Seeder;

class RoleAndAbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);

        $moderator = Bouncer::role()->create([
            'name' => 'moderator',
            'title' => 'Moderator',
        ]);

        $manageUsers = Bouncer::ability()->create([
            'name' => 'manage-users',
            'title' => 'Manage users',
        ]);

        $ban = Bouncer::ability()->create([
            'name' => 'ban-user',
            'title' => 'Ban user',
        ]);

        $assignAdmin = Bouncer::ability()->create([
            'name' => 'assign-admin',
            'title' => 'Assign admin',
        ]);

        $assignModerator = Bouncer::ability()->create([
            'name' => 'assign-moderator',
            'title' => 'Assign moderator',
        ]);

        $deleteAnyThread = Bouncer::ability()->create([
            'name' => 'delete-any-thread',
            'title' => 'Delete any thread',
        ]);

        $deleteAnyPost = Bouncer::ability()->create([
            'name' => 'delete-any-post',
            'title' => 'Delete any post',
        ]);

        Bouncer::allow($admin)->to($assignAdmin);
        Bouncer::allow($admin)->to($assignModerator);
        Bouncer::allow($admin)->to($ban);
        Bouncer::allow($admin)->to($manageUsers);
        Bouncer::allow($admin)->to($deleteAnyThread);
        Bouncer::allow($admin)->to($deleteAnyPost);

        Bouncer::allow($moderator)->to($manageUsers);
        Bouncer::allow($moderator)->to($deleteAnyThread);
        Bouncer::allow($moderator)->to($deleteAnyPost);

        User::whereEmail('admin@uea.ac.uk')->first()->assign('admin');
    }
}
