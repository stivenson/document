<?php

namespace document\Http\Controllers\API;

use document\Http\Requests\API\CreatePhotoAPIRequest;
use document\Http\Requests\API\UpdatePhotoAPIRequest;
use document\Models\Photo;
use document\Repositories\PhotoRepository;
use Illuminate\Http\Request;
use document\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PhotoController
 * @package document\Http\Controllers\API
 */

class PhotoAPIController extends InfyOmBaseController
{
    /** @var  PhotoRepository */
    private $photoRepository;

    public function __construct(PhotoRepository $photoRepo)
    {
        $this->photoRepository = $photoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/photos",
     *      summary="Get a listing of the Photos.",
     *      tags={"Photo"},
     *      description="Get all Photos",
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
     *                  @SWG\Items(ref="#/definitions/Photo")
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
        $this->photoRepository->pushCriteria(new RequestCriteria($request));
        $this->photoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $photos = $this->photoRepository->all();

        return $this->sendResponse($photos->toArray(), 'Photos retrieved successfully');
    }

    /**
     * @param CreatePhotoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/photos",
     *      summary="Store a newly created Photo in storage",
     *      tags={"Photo"},
     *      description="Store Photo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Photo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Photo")
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
     *                  ref="#/definitions/Photo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePhotoAPIRequest $request)
    {
        $input = $request->all();

        $photos = $this->photoRepository->create($input);

        return $this->sendResponse($photos->toArray(), 'Photo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/photos/{id}",
     *      summary="Display the specified Photo",
     *      tags={"Photo"},
     *      description="Get Photo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Photo",
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
     *                  ref="#/definitions/Photo"
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
        /** @var Photo $photo */
        $photo = $this->photoRepository->find($id);

        if (empty($photo)) {
            return Response::json(ResponseUtil::makeError('Photo not found'), 404);
        }

        return $this->sendResponse($photo->toArray(), 'Photo retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePhotoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/photos/{id}",
     *      summary="Update the specified Photo in storage",
     *      tags={"Photo"},
     *      description="Update Photo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Photo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Photo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Photo")
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
     *                  ref="#/definitions/Photo"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePhotoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Photo $photo */
        $photo = $this->photoRepository->find($id);

        if (empty($photo)) {
            return Response::json(ResponseUtil::makeError('Photo not found'), 404);
        }

        $photo = $this->photoRepository->update($input, $id);

        return $this->sendResponse($photo->toArray(), 'Photo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/photos/{id}",
     *      summary="Remove the specified Photo from storage",
     *      tags={"Photo"},
     *      description="Delete Photo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Photo",
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
        /** @var Photo $photo */
        $photo = $this->photoRepository->find($id);

        if (empty($photo)) {
            return Response::json(ResponseUtil::makeError('Photo not found'), 404);
        }

        $photo->delete();

        return $this->sendResponse($id, 'Photo deleted successfully');
    }
}
