<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Rating extends Model
{
    use HasFactory;
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = ['user_id','movie_id','rating','review'];
    /**
     * Summary of casts
     * @var array
     */
    protected $casts = [
      'user_id' => 'integer',
      'movie_id' => 'integer'
    ];
    /**
     * Summary of boot
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rate) {
            $rate->user_id = Auth::id();
        });
    }
    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Summary of movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
