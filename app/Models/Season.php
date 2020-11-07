<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['serie_id', 'number', 'score'];
    // protected $appends = ['links'];

    public function watchedEpisodes()
    {
        return $this->hasOne(WatchedEpisode::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
