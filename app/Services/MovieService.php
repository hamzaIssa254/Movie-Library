<?php

namespace App\Services;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Cache;

class MovieService
{
    /**
     * Summary of listAllMovies
     * @param \Illuminate\Http\Request $request
     * @param int $perPage
     * @return mixed
     */
    public function listAllMovies(Request $request,int $perPage)
    {
        // Generate a unique cache key based on filters and pagination
        $cacheKey = 'movies_' . md5(json_encode($request) . $perPage . request('page', 1));

        // Check if the cached result exists
        $movies = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request,$perPage)
         {
            // Initialize the query builder for the Movie model
            $moviesQuery = Movie::query();

            // Apply genre filter if provided
            if ($request->has('genre')) {
                $moviesQuery->where('genre', $request->input('genre'));
            }

            // Apply director filter if provided
            if ($request->has('director')) {
                $moviesQuery->where('director', $request->input('director'));
            }
              // Apply ordering based on release_year
    if ($request->input('order', 'desc') === 'asc') {
        $moviesQuery->orderBy('release_year', 'asc');
    } else {
        $moviesQuery->orderBy('release_year', 'desc');
    }

            $moviesQuery->select(['title','director','genre','release_year','description'])->withAvg('ratings', 'rating');





            // Return the paginated result of the query
            return $moviesQuery->paginate($perPage);
        });

        return $movies;
    }
    /**
     * Summary of createMovie
     * @param array $data
     * @return Movie|\Illuminate\Database\Eloquent\Model
     */
    public function createMovie(array $data)
    {
        DB::beginTransaction();
        try{
            $movie = Movie::create($data);
            DB::commit();
            return $movie;
        }catch (Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();

            throw $e;
        }


    }
    /**
     * Summary of getMovie
     * @param mixed $id
     * @return MovieResource
     */
    public function getMovie($id)
    {
        return new MovieResource(Movie::findOrFail($id)) ;
    }
    /**
     * Summary of updateMovie
     * @param array $data
     * @param int $id
     * @return Movie|Movie[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateMovie(array $data,int $id)
    {
        $movie = Movie::findOrFail($id);

        // Update the book with the provided data, filtering out null values
        $movie->update(array_filter($data));

        // Return the updated book
        return $movie;
    }
    /**
     * Summary of deleteMovie
     * @param int $id
     * @return void
     */
    public function deleteMovie(int $id)
    {
        $movie = Movie::findOrFail($id);
         $movie->forceDelete();

    }
}

