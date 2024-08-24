<?php

namespace App\Services;
use Exception;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class RatingService
{
    /**
     * Summary of getid
     * @return int|string|null
     */
    private function getid()
    {
        return Auth::id();
    }
/**
 * Summary of createRating
 * @param array $data
 * @return Rating
 */
public function createRating(array $data)
{

    DB::beginTransaction();
    try{
        $id = $this->getid();
        $rate = new Rating();
        $rate->user_id = $id;
        $rate->movie_id= $data['movie_id'];
        $rate->rating = $data['rating'];
        $rate->review = $data['review'];
        $rate->save();
        // $rate = Rating::create([$data]);
        DB::commit();
        return $rate;

    }
    catch (Exception $e) {
        // Rollback the transaction on failure
        DB::rollBack();

        throw $e;
    }
}

}
