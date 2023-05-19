<?php
namespace App\Http\Controllers;

use Throwable;
use App\Models\About;
use App\Services\AboutService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class AboutControllerController
 * @package  App\Http\Controllers
 */
class AboutController extends Controller
{
    private AboutService $service;

    public function __construct(AboutService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *  path="/api/about",
     *  operationId="indexAbout",
     *  tags={"Abouts"},
     *  summary="Get list of About",
     *  description="Returns list of About",
     *  @OA\Response(response=200, description="Successful operation",
     *    @OA\JsonContent(ref="#/components/schemas/About"),
     *  ),
     * )
     *
     * Display a listing of About.
     * @return LengthAwarePaginator
     * @throws Throwable
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->service->paginatedList([], $request->has('all'));
    }

    /**
     * @OA\Post(
     *  operationId="storeAbout",
     *  summary="Insert a new About",
     *  description="Insert a new About",
     *  tags={"Abouts"},
     *  path="/api/about",
     *  @OA\RequestBody(
     *    description="About to create",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *      @OA\Property(
     *      title="data",
     *      property="data",
     *      type="object",
     *      ref="#/components/schemas/About")
     *     )
     *    )
     *  ),
     *  @OA\Response(response="201",description="About created",
     *     @OA\JsonContent(
     *      @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/About"
     *      ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreAboutRequest $request
     * @return array|Builder|Collection|About|Builder[]|About[]
     * @throws Throwable
     */
    public function store(StoreAboutRequest $request): array |Builder|Collection|About
    {
        return $this->service->createModel($request->validated('data'));

    }

    /**
     * @OA\Get(
     *   path="/api/about/{about_id}",
     *   summary="Show a About from his Id",
     *   description="Show a About from his Id",
     *   operationId="showAbout",
     *   tags={"Abouts"},
     *   @OA\Parameter(ref="#/components/parameters/About--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/About"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="About not found"),
     * )
     *
     * @param $crudgeneratorId
     * @return array|Builder|Collection|About
     * @throws Throwable
     */
    public function show($crudgeneratorId): array |Builder|Collection|About
    {
        return $this->service->getModelById($crudgeneratorId);
    }

    /**
     * @OA\Patch(
     *   operationId="updateAbout",
     *   summary="Update an existing About",
     *   description="Update an existing About",
     *   tags={"Abouts"},
     *   path="/api/about/{about_id}",
     *   @OA\Parameter(ref="#/components/parameters/About--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/About"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="About not found"),
     *   @OA\RequestBody(
     *     description="About to update",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/About")
     *      )
     *     )
     *   )
     *
     * )
     *
     * @param UpdateAboutRequest $request
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|About|About[]
     * @throws Throwable
     */
    public function update(UpdateAboutRequest $request, int $crudgeneratorId): array |About|Collection|Builder
    {
        return $this->service->updateModel($request->validated('data'), $crudgeneratorId);

    }

    /**
     * @OA\Delete(
     *  path="/api/about/{about_id}",
     *  summary="Delete a About",
     *  description="Delete a About",
     *  operationId="destroyAbout",
     *  tags={"Abouts"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/About"
     *       ),
     *     ),
     *   ),
     *  @OA\Parameter(ref="#/components/parameters/About--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="About not found"),
     * )
     *
     * @param int $crudgeneratorId
     * @return array|Builder|Builder[]|Collection|About|About[]
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|About
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}