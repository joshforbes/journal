<?php

namespace Tests\Feature;

use App\User;
use App\Journal;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserJournalTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_get_a_list_of_a_users_journals()
    {
        $user = factory(User::class)->create();
        factory(Journal::class)->create(['user_id' => $user->id, 'body' => 'first']);
        factory(Journal::class)->create(['user_id' => $user->id, 'body' => 'second']);

        $response = $this->json('GET', 'api/user/' . $user->id . '/journals');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['body' => 'first'])
            ->assertJsonFragment(['body' => 'second']);
    }
}
