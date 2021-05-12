<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\User::truncate();
        /*
        \App\Models\Comment::truncate();
        \App\Models\Ticket::truncate();
        */

        // should change this to truncate as is faster and
        // resets autoincrements
        \App\Models\Project::query()->delete();

        \App\Models\User::factory(1)->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'type' => 'ADMIN'
        ]);
        \App\Models\User::factory(3)->create([
            'type' => 'PM'
        ]);
        \App\Models\User::factory(10)->create([
            'type' => 'DEV'
        ]);

        \App\Models\Project::factory()
                            ->has(\App\Models\Ticket::factory()->count(3), 'tickets')
                            ->count(4)
                            ->create();

        \App\Models\Project::factory()->count(1)->create();

    }
}
