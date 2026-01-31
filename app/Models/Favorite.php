<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'film_id',
        'title',
        'year',
        'rating',
        'notes',
        'poster_url',
        'imdb_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'decimal:1',
        'year' => 'integer',
    ];

    /**
     * Scope untuk mengurutkan berdasarkan tanggal pembuatan (terbaru dulu)
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope untuk mencari berdasarkan judul film
     */
    public function scopeByTitle($query, $title)
    {
        return $query->where('title', 'like', "%{$title}%");
    }

    /**
     * Scope untuk mencari berdasarkan tahun
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Scope untuk mencari berdasarkan rentang rating
     */
    public function scopeByRatingRange($query, $minRating, $maxRating)
    {
        return $query->whereBetween('rating', [$minRating, $maxRating]);
    }
}