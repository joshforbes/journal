<?php

namespace App\Http\Controllers;

use App\User;
use App\Journal;
use Illuminate\Http\Request;
use App\Http\Resources\Journal as JournalResource;

class UserJournalController extends Controller
{
    public function index($userId)
    {
        $user = User::find($userId);
        $journals = Journal::forUser($user)->get();

        return response()->json(JournalResource::collection($journals), 200);
    }
}
