<?php

namespace App\Models;

use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = ['title','director','genre','release_year','description'];
    /**
     * Summary of casts
     * @var array
     */
    protected $casts = ['release_year' => 'integer'];
    /**
     * Summary of ratings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


}
