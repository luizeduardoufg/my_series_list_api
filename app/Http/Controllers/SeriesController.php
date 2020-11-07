<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Serie;
use App\Models\SerieList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends BaseController
{
    public function __construct(Request $request)
    {
        if ($request->username === Auth::user()->username){
            $this->class = Serie::class;
            $this->serieListId = SerieList::query()
                ->where('username', $request->username)
                ->value('id');
        }
        else {
            dd('Unauthorized');
        }
    }
}