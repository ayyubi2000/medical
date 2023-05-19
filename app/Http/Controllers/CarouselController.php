<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Carousel;
use App\Services\CarouselService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreCarouselRequest;
use App\Http\Requests\UpdateCarouselRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CarouselControllerController
 * @package  App\Http\Controllers
 */
class CarouselController extends Controller
{
    private CarouselService $service;

    public function __construct(CarouselService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/carousels",
     *  operationId="indexCarousel",
     *  tags={"Carousels"},
     *  summary="Get list of Carousel",
     *  description="Returns list of Carousel",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Carousel"),
     *  ),
     * )
     *
     * Display a listing of Carousel.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeCarousel",
     *  summary="Insert a new Carousel",
     *  description="Insert a new Carousel",
     *  tags={"Carousels"},
     *  path="/api/carousels",
     *  @OA\RequestBody(
     *    description="Carousel to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Carousel")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Carousel created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Carousel"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreCarouselRequest $request
     * @return array|Builder|Collection|Carousel|Builder[]|Carousel[]
     * @throws Throwable
     */
    public function store(StoreCarouselRequest $request): array |Builder|Collection|Carousel
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/carousels/{carousel_id}",
     *   summary="Show a Carousel from his Id",
     *   description="Show a Carousel from his Id",
     *   operationId="showCarousel",
     *   tags={"Carousels"},
     *   @OA\Parameter(ref="#/components/parameters/Carousel--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Carousel"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Carousel not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Carousel
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Carousel
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateCarousel",
     *   summary="Update an existing Carousel",
     *   description="Update an existing Carousel",
     *   tags={"Carousels"},
     *   path="/api/carousels/{carousel_id}",
     *   @OA\Parameter(ref="#/components/parameters/Carousel--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Carousel"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Carousel not found"),
     *   @OA\RequestBody(
     *     description="Carousel to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Carousel")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateCarouselRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Carousel|Carousel[]
     * @throws Throwable
     */
    public function update(UpdateCarouselRequest $request, int $crudgeneratorId): array |Carousel|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/carousels/{carousel_id}",
     *  summary="Delete a Carousel",
     *  description="Delete a Carousel",
     *  operationId="destroyCarousel",
     *  tags={"Carousels"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Carousel"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Carousel--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Carousel not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Carousel|Carousel[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Carousel
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}