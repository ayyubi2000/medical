<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\CompanyNew;
use App\Services\CompanyNewService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreCompanyNewRequest;
use App\Http\Requests\UpdateCompanyNewRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CompanyNewControllerController
 * @package  App\Http\Controllers
 */
class CompanyNewController extends Controller
{
    private CompanyNewService $service;

    public function __construct(CompanyNewService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/company-news",
     *  operationId="indexCompanyNew",
     *  tags={"CompanyNews"},
     *  summary="Get list of CompanyNew",
     *  description="Returns list of CompanyNew",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/CompanyNew"),
     *  ),
     * )
     *
     * Display a listing of CompanyNew.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeCompanyNew",
     *  summary="Insert a new CompanyNew",
     *  description="Insert a new CompanyNew",
     *  tags={"CompanyNews"},
     *  path="/api/company-news",
     *  @OA\RequestBody(
     *    description="CompanyNew to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/CompanyNew")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="CompanyNew created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CompanyNew"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreCompanyNewRequest $request
     * @return array|Builder|Collection|CompanyNew|Builder[]|CompanyNew[]
     * @throws Throwable
     */
    public function store(StoreCompanyNewRequest $request): array |Builder|Collection|CompanyNew
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/company-news/{companynew_id}",
     *   summary="Show a CompanyNew from his Id",
     *   description="Show a CompanyNew from his Id",
     *   operationId="showCompanyNew",
     *   tags={"CompanyNews"},
     *   @OA\Parameter(ref="#/components/parameters/CompanyNew--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CompanyNew"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="CompanyNew not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|CompanyNew
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|CompanyNew
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateCompanyNew",
     *   summary="Update an existing CompanyNew",
     *   description="Update an existing CompanyNew",
     *   tags={"CompanyNews"},
     *   path="/api/company-news/{companynew_id}",
     *   @OA\Parameter(ref="#/components/parameters/CompanyNew--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CompanyNew"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="CompanyNew not found"),
     *   @OA\RequestBody(
     *     description="CompanyNew to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/CompanyNew")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateCompanyNewRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|CompanyNew|CompanyNew[]
     * @throws Throwable
     */
    public function update(UpdateCompanyNewRequest $request, int $crudgeneratorId): array |CompanyNew|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/company-news/{companynew_id}",
     *  summary="Delete a CompanyNew",
     *  description="Delete a CompanyNew",
     *  operationId="destroyCompanyNew",
     *  tags={"CompanyNews"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CompanyNew"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/CompanyNew--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="CompanyNew not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|CompanyNew|CompanyNew[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|CompanyNew
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}