<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\WatchedEpisode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpisodesController extends CrudController
{
    public function __construct()
    {
        $this->listId = Auth::user()->list_id;
        $this->class = WatchedEpisode::class;
    }

    public function store(Request $request)
    {
        $serie = Season::query()
            ->where('list_id', Auth::user()->list_id)
            ->where('id', $request->season_id)
            ->first();
        if (!is_null($serie)) {
            $episode = WatchedEpisode::create($request->all());
            $episode->list_id = Auth::user()->list_id;
            $episode->save();
            return response()->json($episode, 201);
        }
        return response()->json(['erro' => 'resource not found.'], 404);
    }
}