<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Season;

class SeasonsController extends BaseController
{
    public function __construct()
    {
        $this->class = Season::class;
    }

    public function searchSeason(int $serieId)
    {
        $seasons = Season::query()
                ->where('serie_id', $serieId)
                ->paginate();
        return $seasons;
    }
}