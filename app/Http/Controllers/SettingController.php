<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class SettingControllerController
 * @package  App\Http\Controllers
 */
class SettingController extends Controller
{
    private SettingService $service;

    public function __construct(SettingService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/settings",
     *  operationId="indexSetting",
     *  tags={"Settings"},
     *  summary="Get list of Setting",
     *  description="Returns list of Setting",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Setting"),
     *  ),
     * )
     *
     * Display a listing of Setting.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeSetting",
     *  summary="Insert a new Setting",
     *  description="Insert a new Setting",
     *  tags={"Settings"},
     *  path="/api/settings",
     *  @OA\RequestBody(
     *    description="Setting to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Setting")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Setting created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Setting"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreSettingRequest $request
     * @return array|Builder|Collection|Setting|Builder[]|Setting[]
     * @throws Throwable
     */
    public function store(StoreSettingRequest $request): array |Builder|Collection|Setting
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/settings/{setting_id}",
     *   summary="Show a Setting from his Id",
     *   description="Show a Setting from his Id",
     *   operationId="showSetting",
     *   tags={"Settings"},
     *   @OA\Parameter(ref="#/components/parameters/Setting--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Setting"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Setting not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Setting
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Setting
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateSetting",
     *   summary="Update an existing Setting",
     *   description="Update an existing Setting",
     *   tags={"Settings"},
     *   path="/api/settings/{setting_id}",
     *   @OA\Parameter(ref="#/components/parameters/Setting--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Setting"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Setting not found"),
     *   @OA\RequestBody(
     *     description="Setting to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Setting")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateSettingRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Setting|Setting[]
     * @throws Throwable
     */
    public function update(UpdateSettingRequest $request, int $crudgeneratorId): array |Setting|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/settings/{setting_id}",
     *  summary="Delete a Setting",
     *  description="Delete a Setting",
     *  operationId="destroySetting",
     *  tags={"Settings"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Setting"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Setting--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Setting not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Setting|Setting[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Setting
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}