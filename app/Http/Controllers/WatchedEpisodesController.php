<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\WatchedEpisode;

class WatchedEpisodesController extends BaseController
{
    public function __construct()
    {
        $this->class = WatchedEpisode::class;
    }
}