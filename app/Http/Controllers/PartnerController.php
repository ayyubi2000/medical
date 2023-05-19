<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Partner;
use App\Services\PartnerService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class PartnerControllerController
 * @package  App\Http\Controllers
 */
class PartnerController extends Controller
{
    private PartnerService $service;

    public function __construct(PartnerService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/partners",
     *  operationId="indexPartner",
     *  tags={"Partners"},
     *  summary="Get list of Partner",
     *  description="Returns list of Partner",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Partner"),
     *  ),
     * )
     *
     * Display a listing of Partner.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storePartner",
     *  summary="Insert a new Partner",
     *  description="Insert a new Partner",
     *  tags={"Partners"},
     *  path="/api/partners",
     *  @OA\RequestBody(
     *    description="Partner to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Partner")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Partner created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Partner"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StorePartnerRequest $request
     * @return array|Builder|Collection|Partner|Builder[]|Partner[]
     * @throws Throwable
     */
    public function store(StorePartnerRequest $request): array |Builder|Collection|Partner
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/partners/{partner_id}",
     *   summary="Show a Partner from his Id",
     *   description="Show a Partner from his Id",
     *   operationId="showPartner",
     *   tags={"Partners"},
     *   @OA\Parameter(ref="#/components/parameters/Partner--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Partner"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Partner not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Partner
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Partner
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updatePartner",
     *   summary="Update an existing Partner",
     *   description="Update an existing Partner",
     *   tags={"Partners"},
     *   path="/api/partners/{partner_id}",
     *   @OA\Parameter(ref="#/components/parameters/Partner--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Partner"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Partner not found"),
     *   @OA\RequestBody(
     *     description="Partner to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Partner")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdatePartnerRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Partner|Partner[]
     * @throws Throwable
     */
    public function update(UpdatePartnerRequest $request, int $crudgeneratorId): array |Partner|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/partners/{partner_id}",
     *  summary="Delete a Partner",
     *  description="Delete a Partner",
     *  operationId="destroyPartner",
     *  tags={"Partners"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Partner"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Partner--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Partner not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Partner|Partner[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Partner
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}