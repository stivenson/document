<?php

namespace document\Http\Controllers\API;

use document\Http\Requests\API\CreateTypedocumentAPIRequest;
use document\Http\Requests\API\UpdateTypedocumentAPIRequest;
use document\Models\Typedocument;
use document\Repositories\TypedocumentRepository;
use Illuminate\Http\Request;
use document\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TypedocumentController
 * @package document\Http\Controllers\API
 */

class TypedocumentAPIController extends InfyOmBaseController
{
    /** @var  TypedocumentRepository */
    private $typedocumentRepository;

    public function __construct(TypedocumentRepository $typedocumentRepo)
    {
        $this->typedocumentRepository = $typedocumentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/typedocuments",
     *      summary="Get a listing of the Typedocuments.",
     *      tags={"Typedocument"},
     *      description="Get all Typedocuments",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Typedocument")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->typedocumentRepository->pushCriteria(new RequestCriteria($request));
        $this->typedocumentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $typedocuments = $this->typedocumentRepository->all();

        return $this->sendResponse($typedocuments->toArray(), 'Typedocuments retrieved successfully');
    }

    /**
     * @param CreateTypedocumentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/typedocuments",
     *      summary="Store a newly created Typedocument in storage",
     *      tags={"Typedocument"},
     *      description="Store Typedocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Typedocument that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Typedocument")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Typedocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypedocumentAPIRequest $request)
    {
        $input = $request->all();

        $typedocuments = $this->typedocumentRepository->create($input);

        return $this->sendResponse($typedocuments->toArray(), 'Typedocument saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/typedocuments/{id}",
     *      summary="Display the specified Typedocument",
     *      tags={"Typedocument"},
     *      description="Get Typedocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Typedocument",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Typedocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Typedocument $typedocument */
        $typedocument = $this->typedocumentRepository->find($id);

        if (empty($typedocument)) {
            return Response::json(ResponseUtil::makeError('Typedocument not found'), 404);
        }

        return $this->sendResponse($typedocument->toArray(), 'Typedocument retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTypedocumentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/typedocuments/{id}",
     *      summary="Update the specified Typedocument in storage",
     *      tags={"Typedocument"},
     *      description="Update Typedocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Typedocument",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Typedocument that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Typedocument")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Typedocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypedocumentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Typedocument $typedocument */
        $typedocument = $this->typedocumentRepository->find($id);

        if (empty($typedocument)) {
            return Response::json(ResponseUtil::makeError('Typedocument not found'), 404);
        }

        $typedocument = $this->typedocumentRepository->update($input, $id);

        return $this->sendResponse($typedocument->toArray(), 'Typedocument updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/typedocuments/{id}",
     *      summary="Remove the specified Typedocument from storage",
     *      tags={"Typedocument"},
     *      description="Delete Typedocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Typedocument",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Typedocument $typedocument */
        $typedocument = $this->typedocumentRepository->find($id);

        if (empty($typedocument)) {
            return Response::json(ResponseUtil::makeError('Typedocument not found'), 404);
        }

        $typedocument->delete();

        return $this->sendResponse($id, 'Typedocument deleted successfully');
    }
}
