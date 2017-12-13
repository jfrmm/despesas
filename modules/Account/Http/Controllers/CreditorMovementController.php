<?php
namespace Modules\Account\Http\Controllers;

use App\Helpers\Http\Api\C3po;
use App\Helpers\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Modules\Account\Filters\MovementSort;
use Modules\Account\Repositories\CreditorMovementRepository as Creditor;
use Modules\Account\Repositories\MovementRepository as Movement;

/**
 * The user's relationship (as a creditor) with movements
 */
class CreditorMovementController extends ModuleController
{
    /**
     * Constructor
     *
     * @param Creditor $entity
     * @param Movement $relatedEntity
     */
    public function __construct(Creditor $entity, Movement $relatedEntity)
    {
        // we need to identify this Module we're in
        parent::__construct('account', $entity, 'creditor', $relatedEntity, 'movement');
    }

    /**
     * Index creditor's movements
     *
     * Display a list of a creditors's owed to movements
     *
     * string ::: [field_name]     ::: Field name to be sorted in ASC or DESC
     *
     * array ::: columns           ::: The fields to be shown
     *
     * string ::: search           ::: A keyword to be used in search
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
     * @param MovementSort $sort
     * @param int $id1
     *
     * @return Response
     */
    public function index(MovementSort $sort, $id1)
    {
        $result = $this->entity->getOne($sort->request(), $id1);

        if (!$result) {
            // Not found
            $statusCode = 404;
            $message = C3po::prepareMessage('crud', $this->entityName, 'error.not_found', $this->module->getName());
            $data = null;
        } else {
            $result = $this->entity->getAllRelated($sort, $id1, ['movements']);

            $statusCode = 200;
            $message = C3po::prepareMessage('crud', $this->entityName, 'relationship.indexed', $this->module->getName());
            $data = C3po::prepareData($result, $this->relatedEntityName);
        }

        // Send response
        return C3po::respond($statusCode, $message, $data);
    }

    // /**
    //  * Add users
    //  *
    //  * Store a newly created company/user relationship
    //  *
    //  * @param CreateRequest $request
    //  * @param id $id1
    //  *
    //  * @return Response
    //  */
    // public function store(CreateRequest $request, $id1)
    // {
    //     $result = $this->entity->getOne($request, $id1);

    //     if (!$result) {
    //         // Not found
    //         $statusCode = 404;
    //         $message = C3po::prepareMessage('crud', $this->entityName, 'error.not_found', $this->module->getName());
    //         $data = null;
    //     } else {
    //         $result = $this->entity->attachMultiple($request, $id1);

    //         $statusCode = 201;
    //         $message = C3po::prepareMessage('crud', $this->entityName, 'relationship.created', $this->module->getName());
    //         $data = C3po::prepareData($result, $this->relatedEntityName);
    //     }

    //     // Send response
    //     return C3po::respond($statusCode, $message, $data);
    // }

    // /**
    //  * Delete users
    //  *
    //  * Remove the specified company/user relationship
    //  *
    //  * @param DeleteRequest $request
    //  * @param id $id1
    //  *
    //  * @return Response
    //  */
    // public function destroy(DeleteRequest $request, $id1)
    // {
    //     $result = $this->entity->getOne($request, $id1);

    //     if (!$result) {
    //         // Not found
    //         $statusCode = 404;
    //         $message = C3po::prepareMessage('crud', $this->entityName, 'error.not_found', $this->module->getName());
    //         $data = null;
    //     } else {
    //         $result = $this->entity->detachMultiple($request, $id1);

    //         $statusCode = 200;
    //         $message = C3po::prepareMessage('crud', $this->entityName, 'relationship.deleted', $this->module->getName());
    //     }
    //     // Send response
    //     return C3po::respond($statusCode, $message);
    // }
}
