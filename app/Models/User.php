<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role() {
        $this->belongsTo(Role::class, 'roles');
    }

    public function movies() {
        return $this->belongsToMany(Movie::class, 'user_movie')->withPivot('status');
    }

    public function isAdmin(): bool {
        return $this->role_id === 1;
    }

     public function listedMovies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'user_movie', 'user_id', 'movie_id')
                    ->withPivot('status') 
                    ->withTimestamps();
    }

     public function favoriteMovies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'user_movie', 'user_id', 'movie_id')
                    ->wherePivot('status', 'favorite') 
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function hasFavorited(Movie $movie): bool
    {
        return $this->favoriteMovies()->where('movie_id', $movie->id)->exists();
    }

}
