<?php

namespace App\Http\Controllers;

use App\User;
use App\Journal;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJournalRequest;
use App\Http\Resources\Journal as JournalResource;

class JournalController extends Controller
{
    public function show($journalId)
    {
        $journal = Journal::findOrFail($journalId);

        return response()->json(new JournalResource($journal), 200);
    }

    public function store(StoreJournalRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        $user->journals()->create(['body' => $request->body]);

        return response('', 201);
    }
}
