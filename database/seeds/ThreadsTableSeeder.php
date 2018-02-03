<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Thread::class, 1)->create([
            'title' => 'Basshunter Review',
            'user_id' => 1,
        ]);

        factory(App\Thread::class, 1)->create([
            'title' => 'Best Artist',
            'user_id' => 2,
        ]);

        factory(App\Thread::class, 1)->create([
            'title' => 'Best Song',
            'user_id' => 3,
        ]);
    }
}
