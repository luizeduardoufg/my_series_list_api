<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends CrudController
{
    public function __construct(Request $request)
    {
        if ($request->username === Auth::user()->username){
            $this->listId = Auth::user()->list_id;
            $this->class = Serie::class;
        }
        else {
            dd('Unauthorized');
        }
    }
}