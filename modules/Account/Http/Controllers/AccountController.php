<?php
namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;
use App\Helpers\Api\Http\C3po;

use Modules\Account\Repositories\Account\AccountRepository as Account;
use Modules\Account\Http\Requests\Account\CreateRequest;
use Modules\Account\Http\Requests\Account\UpdateRequest;
use Modules\Account\Http\Requests\Account\DeleteRequest;

class AccountController extends Controller
{
    /**
     *
     * @var object
     */
    private $entity;

    /**
     * The name of the entity we're refering to in the Controller
     *
     * @var string
     */
    private $entityName;

    /**
     * The module in which the Controller is
     *
     * @var object
     */
    private $module;

    /**
     * Constructor
     *
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->entity = $account;
        $this->entityName = 'account';
        $this->module = Module::find('Account');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $result = $this->entity->getAll($request);

        $statusCode = 200;
        $message = C3po::prepareMessage('crud', $this->entityName, 'indexed', $this->module->getName());
        $data = C3po::prepareData($result, $this->entityName);

        return C3po::respond($statusCode, $message, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(CreateRequest $request)
    {
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
     * @param  UpdateRequest $request
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
