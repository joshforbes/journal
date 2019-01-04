<?php

namespace Tests\Feature;

use App\User;
use App\Journal;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JournalTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_show_a_single_journal_entry()
    {
        $journal = factory(Journal::class)->create();

        $response = $this->json('GET', 'api/journal/' . $journal->id);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $journal->id]);
    }

    /**
     * @test
     */
    public function it_creates_a_new_journal_entry_from_webhook()
    {
        $user = factory(User::class)->create();

        $response = $this->json('POST', 'api/journal/', [
            'From' => $user->email,
            'body-plain' => 'new post'
        ]);

        $response->dump()->assertStatus(201);
        $this->assertDatabaseHas('journals', [
            'user_id' => $user->id,
            'body' => 'new post'
        ]);
    }
}
