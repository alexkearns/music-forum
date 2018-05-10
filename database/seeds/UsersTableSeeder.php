<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create([
            'email' => 'admin@uea.ac.uk',
            'password' => bcrypt('password'),
            'name' => 'Administrator',
        ]);

        factory(App\User::class, 1)->create([
            'email' => 'matty@uea.ac.uk',
            'password' => bcrypt('password'),
            'name' => 'Matty Williams',
        ]);

        factory(App\User::class, 1)->create([
            'email' => 'alex@uea.ac.uk',
            'password' => bcrypt('password'),
            'name' => 'Alex Kearns',
        ]);

        factory(App\User::class, 1)->create([
            'email' => 'chris@uea.ac.uk',
            'password' => bcrypt('password'),
            'name' => 'Chris Irvine',
        ]);

        factory(App\User::class, 1)->create([
            'email' => 'sam@uea.ac.uk',
            'password' => bcrypt('password'),
            'name' => 'Sam Gibson',
        ]);

        factory(App\User::class, 1)->create([
            'email' => '2YyjHUrjmq0W7TO@uea.ac.uk',
            'password' => bcrypt('96GWyVqIrfhwGxX'),
            'name' => 'Reset Password Catch-All',
        ]);

        factory(App\User::class, 50)->create();
    }
}
