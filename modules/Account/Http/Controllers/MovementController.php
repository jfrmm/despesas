<?php
namespace Modules\Account\Http\Controllers;

use App\Helpers\Http\Api\C3po;
use App\Helpers\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Filters\MovementSort;
use Modules\Account\Http\Requests\Movement\CreateRequest;
use Modules\Account\Http\Requests\Movement\DeleteRequest;
use Modules\Account\Http\Requests\Movement\UpdateRequest;
use Modules\Account\Repositories\MovementRepository as Movement;
use Nwidart\Modules\Facades\Module;

/**
 * The movements in the accounts
 */
class MovementController extends ModuleController
{
    /**
     * Constructor
     *
     * @param Movement $entity
     */
    public function __construct(Movement $entity)
    {
        // we need to identify this Module we're in
        parent::__construct('account', $entity, 'movement');
    }

    /**
     * Display a listing of the resource.
     *
     * string ::: [field_name]     ::: Field name to be sorted in ASC or DESC
     *
     * array ::: columns           ::: The fields to be shown
     *
     * string ::: search           ::: A keyword to be used in search
     *
     * array ::: with              ::: The relationships that should be retrieved
     *
     * int ::: page                ::: The page number
     *
     * int ::: size                ::: The number of items in each page
     *
     * @request
     * @param string    [field_name]    Field name to be sorted in ASC or DESC
     * @param array     columns         The fields to be shown
     * @param string    search          A keyword to be used in search
     * @param array     with            The relationships that should be retrieved
     * @param int       page            The page number
     * @param int       size            The number of items in each page
     *
     * @function
     * @param  MovementSort $sort
     * @return Response
     */
    public function index(MovementSort $sort)
    {
        $result = $this->entity->getAll($sort);

        $statusCode = 200;
        $message = C3po::prepareMessage('crud', $this->entityName, 'indexed', $this->module->getName());
        $data = C3po::prepareData($result, $this->entityName);

        return C3po::respond($statusCode, $message, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest $request
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $request->request->add(['creator_id' => Auth::user()->id]);

        $result = $this->entity->createOrUpdate($request);

        $statusCode = 201;
        $message = C3po::prepareMessage('crud', $this->entityName, 'created', $this->module->getName());
        $data = C3po::prepareData($result, $this->entityName);

        // Send response
        return C3po::respond($statusCode, $message, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $result = $this->entity->getOne($request, $id);

        if (!$result) {
            // Not found
            $statusCode = 404;
            $message = C3po::prepareMessage('crud', $this->entityName, 'error.not_found', $this->module->getName());
            $data = null;
        } else {
            $statusCode = 200;
            $message = C3po::prepareMessage('crud', $this->entityName, 'read', $this->module->getName());
            $data = C3po::prepareData($result, $this->entityName);
        }

        // Send response
        return C3po::respond($statusCode, $message, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->entity->getOne($request, $id);

        if (!$result) {
            // Not found
            $statusCode = 404;
            $message = C3po::prepareMessage('crud', $this->entityName, 'error.not_found', $this->module->getName());
            $data = null;
        } else {
            $result = $this->entity->createOrUpdate($request, $result);

            $statusCode = 200;
            $message = C3po::prepareMessage('crud', $this->entityName, 'updated', $this->module->getName());
            $data = C3po::prepareData($result, $this->entityName);
        }

        // Send response
        return C3po::respond($statusCode, $message, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteRequest $request
     * @param  int $id
     * @return Response
     */
    public function destroy(DeleteRequest $request, $id)
    {
        $withTrashed = false; // for now we're not factoring in the trashed items
        $hardDelete = $withTrashed ? true : false;
        $result = $this->entity->getOne($request, $id);

        if (!$result) {
            // Not found
            $statusCode = 404;
            $message = C3po::prepareMessage('crud', $this->entityName, 'error.not_found', $this->module->getName());
        } else {
            $deleted = $result;
            $this->entity->deleteOne($request, $id);

            $statusCode = 200;
            $message = C3po::prepareMessage('crud', $this->entityName, 'deleted', $this->module->getName());
        }

        // Send response
        return C3po::respond($statusCode, $message);
    }
}
