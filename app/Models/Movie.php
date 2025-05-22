<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'imdb_score',
        'image_url',
        'trailer_url',
        'release_year',
        'duration',
        'total_episode',
        'type_id',
    ];

    public function genres() {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_movie')->withPivot('status');
    }
}

