<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\SendJournalPrompt;
use App\Mail\JournalPrompt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendJournalPromptTest extends TestCase
{
    /**
     * @test
     */
    public function it_sends_a_journal_prompt_to_every_user()
    {
        Mail::fake();

        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        (new SendJournalPrompt)->handle();

        Mail::assertSent(JournalPrompt::class, function ($mail) use ($firstUser) {
            return $mail->hasTo($firstUser->email);
        });
        Mail::assertSent(JournalPrompt::class, function ($mail) use ($secondUser) {
            return $mail->hasTo($secondUser->email);
        });
    }
}
