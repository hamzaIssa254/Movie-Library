<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Services\ApiResponseService;
use App\Services\MovieService;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    /**
     * Summary of movieservice
     * @var
     */
    protected $movieservice;
    /**
     * Summary of __construct
     * @param \App\Services\MovieService $movie
     */
    public function __construct(MovieService $movie)
    {
        $this->movieservice = $movie;
    }
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // $filters = $request->only(['director'],['genre']);
        $perPage = $request->input('per_page', 15); // Default to 15 if not provided

        // Get the list of books with the specified filters and pagination
        $movies = $this->movieservice->listAllMovies($request, $perPage);

        // Return a paginated response with the list of books
        return ApiResponseService::paginated(MovieResource::collection($movies), 'Movies retrieved successfully');
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\MovieRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MovieRequest $request)
    {
        $data = $request->validated();
        $movie = $this->movieservice->createMovie($data);
        return ApiResponseService::success($movie,"Movie created successfuly",201);

    }

    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $movie = $this->movieservice->getMovie($id);
        return ApiResponseService::success($movie,"Movie retrive successfull");
    }


    /**
     * Summary of update
     * @param \App\Http\Requests\UpdateMovieRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMovieRequest $request, int $id)
    {
        $data = $request->validated();
        $movie = $this->movieservice->updateMovie($data,$id);
        return ApiResponseService::success($movie,'update success',201);
    }

    /**
     * Summary of destroy
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
       $this->movieservice->deleteMovie($id);
       return ApiResponseService::success(null,'delete success',201);
    }
}
