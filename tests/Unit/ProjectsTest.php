<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cannot_update_collaborators_to_archived_project()
    {
        $dev = \App\Models\User::factory()->create([
            'type' => 'DEV'
        ]);
        $pm = \App\Models\User::factory()->create([
            'type' => 'PM'
        ]);
        $adm = \App\Models\User::factory()->create([
            'type' => 'ADMIN'
        ]);

        $users = [$dev, $pm, $adm];

        $project = \App\Models\Project::factory()->create([
            'archived' => true
        ]);

        foreach ($users as $user) {
            $project->collaborators()->attach($user->id);

            $res = $this->actingAs($user)
                        ->post('/projects'.'/'.$project->id.'/users', [
                            'users' => [1,2,3],
                        ]);

            $res2 = $this->actingAs($user)
                        ->delete('/projects'.'/'.$project->id.'/users', [
                            'users' => [1,2,3],
                        ]);
            
            $res->assertForbidden();       
            $res2->assertForbidden();          
        }
    }
}