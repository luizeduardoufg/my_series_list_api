<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeasonsController
{
    public function __construct(Request $request)
    {
        if ($request->username !== Auth::user()->username){
            dd('Unauthorized');
        }
    }

    public function index(Request $request)
    {
        return Season::query()->paginate($request->per_page);
    }

    public function show(int $id)
    {
        $season = Season::query()
            ->where('id', $id)
            ->get();
        if (!is_null($season))
            return response()->json($season);
        return response()->json(['erro' => 'season not found.'], 404);
    }

    public function store(Request $request)
    {
        if (Serie::findOrFail($request->serie_id)->list_id === Auth::user()->list_id){
            return response()->json(Season::create($request->all()), 201);
        }
    }

    public function update(Request $request, int $id)
    {
        $season = Season::find($id);
        if (!is_null($season)){
            $season->fill($request->all());
            $season->save();
            return response()->json($season);
        }
        return response()->json(['erro' => 'season not found.'], 404);
    }

    public function destroy(int $id)
    {
        $removed = Season::destroy($id);
        if ($removed === 0){
            return response()->json(['erro' => 'season not found.'], 404);
        }
        return response()->json('Season removed.');
    }

    public function searchSeason(int $serieId)
    {
        $seasons = Season::query()
                ->where('serie_id', $serieId)
                ->paginate();
        return $seasons;
    }
}