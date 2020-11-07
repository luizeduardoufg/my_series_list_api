<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\SerieList;

class SeriesListController extends BaseController
{
    public function __construct()
    {
        $this->class = SerieList::class;
    }
}