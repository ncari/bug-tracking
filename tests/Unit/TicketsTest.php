<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cannot_add_tickets_to_archived_project()
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
                        ->post('/projects'.'/'.$project->id.'/tickets', [
                            'name' => 'Ticket name',
                            'description' => 'ticket description',
                            'priority' => 'L',
                        ]);
                        
            $res->assertForbidden();
        }
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cannot_add_comments_to_archived_ticket()
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
            'archived' => false
        ]);

        $ticket = new \App\Models\Ticket([
            'name' => 'Ticket name',
            'description' => 'ticket desc',
            'status' => 'ARCHIVED',
            'priority' => 'L',
        ]);
        $project->tickets()->save($ticket);

        foreach ($users as $user) {
            $project->collaborators()->attach($user->id);

            $res = $this->actingAs($user)
                        ->post('/tickets'.'/'.$ticket->id.'/comments', [
                            'text' => 'some comment',
                        ]);
                        
            $res->assertForbidden();
        }
    }

    public function test_dev_cannot_update_archived_ticket(){
        $dev = \App\Models\User::factory()->create([
            'type' => 'DEV'
        ]);

        $project = \App\Models\Project::factory()->create([
            'archived' => false
        ]);

        $ticket = new \App\Models\Ticket([
            'name' => 'Ticket name',
            'description' => 'ticket desc',
            'status' => 'ARCHIVED',
            'priority' => 'L',
        ]);
        $project->tickets()->save($ticket);

        $project->collaborators()->attach($dev->id);

        $res = $this->actingAs($dev)
                    ->put('/tickets'.'/'.$ticket->id, [
                        'name' => 'ther ticket name',
                        'description' => 'other ticket description',
                        'status' => 'OPEN',
                        'priority' => 'M'
                    ]);
                    
        $res->assertForbidden();
    }
}
