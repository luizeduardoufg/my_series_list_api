<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeasonsController extends CrudController
{
    public function __construct(Request $request)
    {
        if ($request->username === Auth::user()->username){
            $this->listId = Auth::user()->list_id;
            $this->class = Season::class;
        }
        else {
            dd('Unauthorized');
        }
    }

    public function store(Request $request)
    {
        $serie = Serie::query()
            ->where('list_id', Auth::user()->list_id)
            ->where('id', $request->serie_id)
            ->first();
        if (!is_null($serie)) {
            $season = Season::create($request->all());
            $season->list_id = Auth::user()->list_id;
            $season->save();
            return response()->json($season, 201);
        }
        return response()->json(['erro' => 'resource not found.'], 404);
    }
}