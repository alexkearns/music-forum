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
    }
}
