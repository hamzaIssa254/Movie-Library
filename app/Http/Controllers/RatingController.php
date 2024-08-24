<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Movie;
use App\Services\ApiResponseService;
use App\Services\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Summary of ratingservice
     * @var
     */
    protected $ratingservice;
    /**
     * Summary of __construct
     * @param \App\Services\RatingService $rating
     */
    public function __construct(RatingService $rating)
    {
        $this->ratingservice = $rating;
    }
   /**
    * Summary of addRate
    * @param \App\Http\Requests\RatingRequest $request
    * @return \Illuminate\Http\JsonResponse
    */
   public function addRate(RatingRequest $request)
   {
    $data = $request->validated();
    $rate = $this->ratingservice->createRating($data);
    return ApiResponseService::success($rate,'rate add success',201);

   }

}
