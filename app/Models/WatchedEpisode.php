<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchedEpisode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['watched', 'total_watched'];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
