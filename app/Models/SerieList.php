<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieList extends Model
{
    public $table = 'series_list';
    public $timestamps = false;
    protected $fillable = ['username'];
    // protected $appends = ['links'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    // public function getLinksAttribute() : array
    // {
    //     return [
    //         'self' => '/api/series/' . $this->id,
    //         'seasons' => '/api/series/' . $this->id . '/seasons'
    //     ];
    // }
}