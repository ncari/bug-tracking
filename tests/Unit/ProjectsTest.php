<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Mail\TicketCreated;

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

    public function test_send_email_to_project_subscribers(){

        \Illuminate\Support\Facades\Mail::fake();

        $project = \App\Models\Project::factory()->create([
            'archived' => false
        ]);
        $pm = \App\Models\User::factory()->create([
            'type' => 'PM',
        ]);
        $dev2 = \App\Models\User::factory()->create([
            'type' => 'DEV',
        ]);
        $dev3 = \App\Models\User::factory()->create([
            'type' => 'DEV'
        ]);

        $project->collaborators()->attach($pm);
        $project->collaborators()->attach($dev2);
        $project->collaborators()->attach($dev3);

        $project->subscribers()->attach($pm);
        $project->subscribers()->attach($dev2);

        $res = $this->actingAs($pm)
            ->post('/projects'.'/'.$project->id.'/tickets', [
                'name' => 'ticket name',
                'description' => 'ticket description',
                'priority' => 'L'
            ]);
        
        \Illuminate\Support\Facades\Mail::assertSent(TicketCreated::class, 2);
    }
}