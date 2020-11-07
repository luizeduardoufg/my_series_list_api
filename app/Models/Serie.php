<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['name', 'seasons_qt', 'image', 'status', 'serie_list_id'];
    protected $appends = ['links'];

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function serieList()
    {
        return $this->belongsTo(SerieList::class);
    }

    public function getLinksAttribute() : array
    {
        return [
            'self' => '/api/series/' . $this->id,
            'seasons' => '/api/series/' . $this->id . '/seasons'
        ];
    }
}