<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class CrudController
{
    protected $listId;
    protected $class;

    public function index(Request $request)
    {
        return $this->class::query()
            ->where('list_id', $this->listId)
            ->paginate($request->per_page);
    }

    public function show(int $id)
    {
        $resource = $this->class::query()
            ->where('list_id', $this->listId)
            ->where('id', $id)
            ->get();
        if (!is_null($resource))
            return response()->json($resource);
        return response()->json(['erro' => 'resource not found.'], 404);
    }

    public function update(Request $request, int $id)
    {
        $resource = $this->class::query()
            ->where('list_id', Auth::user()->list_id)
            ->where('id', $id)
            ->first();
        if (!is_null($resource)){
            $resource->fill($request->all());
            $resource->save();
            return response()->json($resource);
        }
        return response()->json(['erro' => 'resource not found.'], 404);
    }

    public function store(Request $request)
    {
        $resource = $this->class::create($request->all());
        $resource->list_id = Auth::user()->list_id;
        $resource->save();
        return response()->json($resource, 201);
    }

    public function destroy(int $id)
    {
        $resource = $this->class::query()
            ->where('list_id', Auth::user()->list_id)
            ->where('id', $id)
            ->first();
        if (!is_null($resource)) {
            $removed = $resource->delete();
            if ($removed === 0){
                return response()->json(['erro' => 'resource not found.'], 404);
            }
            return response()->json('resource removed.');
        }
        return response()->json(['erro' => 'resource not found.'], 404);
    }
}