<?php

namespace App;

use App\Mail\JournalPrompt;
use Illuminate\Support\Facades\Mail;

class SendJournalPrompt
{
    public function handle()
    {
        $users = User::all();

        Mail::to($users)->send(new JournalPrompt);
    }
}