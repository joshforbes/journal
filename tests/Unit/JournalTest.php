<?php

namespace Tests\Unit;

use App\User;
use App\Journal;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JournalTest extends TestCase
{
    /**
     * @test
     */
    public function it_only_returns_journals_for_the_specified_user()
    {
        $user = factory(User::class)->create();
        $myJournal = factory(Journal::class)->create([
            'user_id' => $user->id,
            'body' => 'My journal'
        ]);
        $otherJournal = factory(Journal::class)->create(['body' => 'Not my journal']);

        $result = Journal::forUser($user)->get();

        $this->assertContains($myJournal->body, $result->map->body);
        $this->assertNotContains($otherJournal->body, $result->map->body);
    }
}
