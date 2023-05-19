<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class TranslationControllerController
 * @package  App\Http\Controllers
 */
class TranslationController extends Controller
{
    private TranslationService $service;

    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/translations",
     *  operationId="indexTranslation",
     *  tags={"Translations"},
     *  summary="Get list of Translation",
     *  description="Returns list of Translation",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/Translation"),
     *  ),
     * )
     *
     * Display a listing of Translation.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeTranslation",
     *  summary="Insert a new Translation",
     *  description="Insert a new Translation",
     *  tags={"Translations"},
     *  path="/api/translations",
     *  @OA\RequestBody(
     *    description="Translation to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/Translation")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="Translation created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Translation"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreTranslationRequest $request
     * @return array|Builder|Collection|Translation|Builder[]|Translation[]
     * @throws Throwable
     */
    public function store(StoreTranslationRequest $request): array |Builder|Collection|Translation
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/translations/{translation_id}",
     *   summary="Show a Translation from his Id",
     *   description="Show a Translation from his Id",
     *   operationId="showTranslation",
     *   tags={"Translations"},
     *   @OA\Parameter(ref="#/components/parameters/Translation--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Translation"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Translation not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|Translation
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|Translation
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateTranslation",
     *   summary="Update an existing Translation",
     *   description="Update an existing Translation",
     *   tags={"Translations"},
     *   path="/api/translations/{translation_id}",
     *   @OA\Parameter(ref="#/components/parameters/Translation--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Translation"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Translation not found"),
     *   @OA\RequestBody(
     *     description="Translation to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Translation")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateTranslationRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Translation|Translation[]
     * @throws Throwable
     */
    public function update(UpdateTranslationRequest $request, int $crudgeneratorId): array |Translation|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/translations/{translation_id}",
     *  summary="Delete a Translation",
     *  description="Delete a Translation",
     *  operationId="destroyTranslation",
     *  tags={"Translations"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Translation"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/Translation--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Translation not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|Translation|Translation[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Translation
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}