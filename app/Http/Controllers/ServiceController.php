<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ServiceControllerController
 * @package  App\Http\Controllers
 */
class ServiceController extends Controller
{
    private ServiceService $service;

    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/services",
     *  operationId="indexService",
     *  tags={"Services"},
     *  summary="Get list of Service",
     *  description="Returns list of Service",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Service"),
     *  ),
     * )
     *
     * Display a listing of Service.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeService",
     *  summary="Insert a new Service",
     *  description="Insert a new Service",
     *  tags={"Services"},
     *  path="/api/services",
     *  @OA\RequestBody(
     *    description="Service to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Service")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Service created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Service"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreServiceRequest $request
     * @return array|Builder|Collection|Service|Builder[]|Service[]
     * @throws Throwable
     */
    public function store(StoreServiceRequest $request): array |Builder|Collection|Service
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/services/{service_id}",
     *   summary="Show a Service from his Id",
     *   description="Show a Service from his Id",
     *   operationId="showService",
     *   tags={"Services"},
     *   @OA\Parameter(ref="#/components/parameters/Service--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Service"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Service not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Service
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Service
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateService",
     *   summary="Update an existing Service",
     *   description="Update an existing Service",
     *   tags={"Services"},
     *   path="/api/services/{service_id}",
     *   @OA\Parameter(ref="#/components/parameters/Service--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Service"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Service not found"),
     *   @OA\RequestBody(
     *     description="Service to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Service")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateServiceRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Service|Service[]
     * @throws Throwable
     */
    public function update(UpdateServiceRequest $request, int $crudgeneratorId): array |Service|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/services/{service_id}",
     *  summary="Delete a Service",
     *  description="Delete a Service",
     *  operationId="destroyService",
     *  tags={"Services"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Service"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Service--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Service not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Service|Service[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Service
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}