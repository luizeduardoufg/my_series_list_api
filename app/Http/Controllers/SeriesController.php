<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\SerieList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController
{
    private $listId;

    public function __construct(Request $request)
    {
        if ($request->username === Auth::user()->username){
            $this->listId = Auth::user()->list_id;
        }
        else {
            dd('Unauthorized');
        }
    }

    public function index(Request $request)
    {
        return Serie::query()
            ->where('list_id', $this->listId)
            ->paginate($request->per_page);
    }

    public function show(int $id)
    {
        $serie = Serie::query()
            ->where('list_id', $this->listId)
            ->where('id', $id)
            ->get();
        if (!is_null($serie))
            return response()->json($serie);
        return response()->json(['erro' => 'serie not found.'], 404);
    }

    public function update(Request $request, int $id)
    {
        $serie = Serie::find($id);
        if (!is_null($serie)){
            $serie->fill($request->all());
            $serie->save();
            return response()->json($serie);
        }
        return response()->json(['erro' => 'serie not found.'], 404);
    }

    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        $serie->list_id = Auth::user()->list_id;
        $serie->save();
        return response()->json($serie, 201);
    }

    public function destroy(int $id)
    {
        $removed = Serie::destroy($id);
        if ($removed === 0){
            return response()->json(['erro' => 'serie not found.'], 404);
        }
        return response()->json('Serie removed.');
    }
}