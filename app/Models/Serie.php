<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['name', 'seasons_qt', 'image', 'status'];
    protected $appends = ['links'];
    protected $hidden = ['list_id'];

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'list_id');
    }

    public function getLinksAttribute() : array
    {
        return [
            'self' => '/api/series/' . $this->id,
            'seasons' => '/api/series/' . $this->id . '/seasons'
        ];
    }
}