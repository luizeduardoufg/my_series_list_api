<?php

namespace App\Http\Controllers;

use App\Models\SerieList;
use Illuminate\Http\Request;

abstract class BaseController
{
    protected $class;
    protected $serieListId;

    public function index(Request $request)
    {
        return $this->class::query()
            ->where('serie_list_id', $this->serieListId)
            ->paginate($request->per_page);
    }

    public function show(int $id)
    {
        $resource = $this->class::query()
            ->where('serie_list_id', $this->serieListId)
            ->where('id', $id)
            ->get();
        if (!is_null($resource))
            return response()->json($resource);
        return response()->json(['erro' => 'resource not found.'], 404);
    }

    public function update(Request $request, int $id)
    {
        $resource = $this->class::find($id);
        if (!is_null($resource)){
            $resource->fill($request->all());
            $resource->save();
            return response()->json($resource);
        }
        return response()->json(['erro' => 'resource not found.'], 404);
    }

    public function store(Request $request)
    {
        return response()->json($this->class::create($request->all()), 201);
    }

    public function destroy(int $id)
    {
        $removed = $this->class::destroy($id);
        if ($removed === 0){
            return response()->json(['erro' => 'resource not found.'], 404);
        }
        return response()->json('');
    }
}