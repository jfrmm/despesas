<?php
namespace App\Helpers\Http\Controllers;

use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;

/**
 * This class adds some useful common properties to be used
 * in our Modules Controllers
 */
class ModuleController extends Controller
{
    /**
     * The module in which the Controller is
     *
     * @var object
     */
    protected $module;

    /**
     * The entity we're refering to in the Controller
     *
     * @var object
     */
    protected $entity;

    /**
     * The name of the entity we're refering to in the Controller
     *
     * @var string
     */
    protected $entityName;

    /**
     * The entity related to the main entity
     * we're refering to in the Controller
     *
     * @var string
     */
    protected $relatedEntity;

    /**
     * The name of the entity related to the main entity
     * we're refering to in the Controller
     *
     * @var string
     */
    protected $relatedEntityName;

    /**
     * Constructor
     *
     * @param Module $module
     * @param Model $entity
     * @param string $entityName
     * @param Model $relatedEntity
     * @param string $relatedEntityName
     */
    public function __construct($module, $entity, $entityName, $relatedEntity = null, $relatedEntityName = null)
    {
        $this->module = Module::find($module);
        $this->entity = $entity;
        $this->entityName = $entityName;

        if ($relatedEntity and $relatedEntityName) {
            $this->relatedEntity = $relatedEntity;
            $this->relatedEntityName = $relatedEntityName;
        }
    }
}
