<?php
namespace App\Helpers\BaseRepository\Eloquent;

use App\Helpers\BaseRepository\Contracts\BaseRepositoryInterface;
use App\Helpers\BaseRepository\Exceptions\BaseRepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

/**
 * This class serves as a basic way to associate a repository to a model.
 * That model must use App\Helpers\DedicatedFiltering\Searchable, and
 * have an array $searchable with the items that should be used in search
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @param App $app

     * @throws BaseRepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract protected function model();

    /**
     * @return Model

     * @throws BaseRepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        return $this->model = $model;
    }

    /**
     * List all items
     *
     * @param QuerySort $sort
     * @param array $columns
     * @param array $eagerLoad
     *
     * @return Model
     */
    public function all($sort, $columns = ['*'], $eagerLoad = [])
    {
        // get the request associated with the sort
        $request = $sort->request();

        // get model's searchable items
        $searchable = $this->model->getSearchable();

        // get search term
        $search = $request->input('search');

        // get select columns
        $columns = ($columns == ['*']) ? $request->input('columns') : $columns;
        $columns = (empty($columns) or !is_array($columns)) ? [$this->model->getTable() . '.*'] : $columns;

        // get eager loading relationships
        $eagerLoad = ($eagerLoad == []) ? $request->input('with') : $eagerLoad;
        $eagerLoad = (empty($eagerLoad) or !is_array($eagerLoad)) ? null : $eagerLoad;

        // get page parameter
        $page = $request->input('page');

        // get items
        $items = $this->model
        // search by searchable fields
            ->when($search, function ($query) use ($search, $searchable) {
                if ($searchable) {
                    $query->where(function ($query) use ($search, $searchable) {
                        foreach ($searchable as $s) {
                            $query->orWhere($s, 'LIKE', '%' . $search . '%');
                        }
                    });
                }
            })
        // sort columns
            ->sort($sort)
        // select columns
            ->select(array_merge([$this->model->getKeyName()], $columns))
        // set eager loading relationships
            ->when($eagerLoad, function ($query) use ($eagerLoad) {
                $query->with($eagerLoad);
            })
        // paginate
            ->when($page, function ($query) use ($search, $request) {
                $size = ($request->has('size')) ? $request->size : config('gdpr.pagination_size');
                return $query->paginate($size);
            });

        return $items;
    }

    /**
     * List an item's relationship.
     *
     * @param QuerySort $sort
     * @param array $columns
     * @param array $eagerLoad
     *
     * @return Model
     */
    public function allRelated($sort, $id, $columns = ['*'], $eagerLoad = [])
    {
        // get the request associated with the sort
        $request = $sort->request();

        // get relationship model's searchable items
        $relatedClass = get_class($this->model->{$eagerLoad[0]}()->getRelated());
        $relatedModel = new $relatedClass;
        $searchable = $relatedModel->getSearchable();

        // get search term
        $search = $request->input('search');

        // get select columns
        $columns = ($columns == ['*']) ? $request->input('columns') : $columns;
        $columns = (empty($columns) or !is_array($columns)) ? null : $columns;

        // get page parameter
        $page = $request->input('page');

        // get item's item
        $items = $this->model
            ->find($id, array_merge([$this->model->getKeyName()]))
            ->{$eagerLoad[0]}()
        // search by searchable fields
            ->when($search, function ($query) use ($search, $searchable) {
                if ($searchable) {
                    $query->where(function ($query) use ($search, $searchable) {
                        foreach ($searchable as $s) {
                            $query->orWhere($s, 'LIKE', '%' . $search . '%');
                        }
                    });
                }
            })
        // sort columns
            ->sort($sort)
        // select columns
            ->when($columns, function ($query) use ($columns) {
                $query->select(array_merge([$this->model->getKeyName()], $columns));
            })
        // paginate
            ->when($page, function ($query) use ($search, $request) {
                $size = ($request->has('size')) ? $request->size : config('gdpr.pagination_size');
                return $query->paginate($size);
            });

        return $items;
    }

    /**
     * Create an item
     *
     * @param Request $request
     *
     * @return Model
     */
    public function create($request)
    {
        $item = $this->model->create($request->all());

        if ($item) {
            $item = $this->find($request, $item->id);
        }

        return $item;
    }

    /**
     * Find an item
     *
     * @param Request $request
     * @param mixed $id
     * @param array $columns
     * @param array $eagerLoad
     * @param bool $withTrashed
     *
     * @return Model
     */
    public function find($request, $id, $columns = ['*'], $eagerLoad = [], $withTrashed = false)
    {
        // get select columns
        $columns = ($columns == ['*']) ? $request->input('columns') : $columns;
        $columns = (empty($columns) or !is_array($columns)) ? [$this->model->getTable() . '.*'] : $columns;

        // get eager loading relationships
        $eagerLoad = ($eagerLoad == []) ? $request->input('with') : $eagerLoad;
        $eagerLoad = (empty($eagerLoad) or !is_array($eagerLoad)) ? null : $eagerLoad;

        // get item
        $item = $this->model
        // set eager loading relationships
            ->when($eagerLoad, function ($query) use ($eagerLoad) {
                $query->with($eagerLoad);
            })
        // get trashed elements also
            ->when($withTrashed, function ($query) {
                $query->withTrashed();
            })
            ->find($id, array_merge([$this->model->getKeyName()], $columns));

        return $item;
    }

    /**
     * Find an item, given a field
     *
     * @param Request $request
     * @param string $field
     *
     * @return Model
     */
    public function findByField($request, $field)
    {
        // get field's value
        $fieldValue = $request->input($field);

        $item = $this->model
            ->when($fieldValue, function ($query) use ($field, $fieldValue) {
                $query->where($field, $fieldValue);
            })
            ->first();

        return $item;
    }

    /**
     * Update an item
     *
     * @param array $data
     * @param mixed $id
     * @param array $columns
     * @param string $key
     *
     * @return Model
     */
    public function update($request, $id, $columns = ['*'], $eagerLoad = [])
    {
        // get select columns
        $columns = ($columns == ['*']) ? $request->input('columns') : $columns;
        $columns = (empty($columns) or !is_array($columns)) ? [$this->model->getTable() . '.*'] : $columns;

        // get eager loading relationships
        $eagerLoad = ($eagerLoad == []) ? $request->input('with') : $eagerLoad;
        $eagerLoad = (empty($eagerLoad) or !is_array($eagerLoad)) ? null : $eagerLoad;

        // get model's key name
        $keyName = $this->model->getKeyName();

        $item = $this->model->where($keyName, '=', $id)->first();

        // update item
        $item->update($request->all());

        $item->touch();

        $item = $item
        // set eager loading relationships
        ->when($eagerLoad, function ($query) use ($eagerLoad) {
            $query->with($eagerLoad);
        })
            ->find($id, array_merge([$this->model->getKeyName()], $columns));

        return $item;
    }

    /**
     * Delete an item
     *
     * @param Request $request
     * @param mixed $id
     * @param bool $hardDelete
     *
     * @return mixed
     */
    public function delete($request, $id, $hardDelete = false)
    {
        // get hard delete
        $hardDelete = (!$hardDelete) ? $request->input('hard_delete') : $hardDelete;
        $hardDelete = (empty($hardDelete)) ? false : $hardDelete;

        // get item
        $item = $this->model->withTrashed()->find($id);

        if ($hardDelete) {
            $item->forceDelete();
        } else {
            $item->delete();
        }
    }

    /**
     * Attach items in a many to many relationship
     *
     * @param Request $request
     * @param mixed $id
     *
     * @return mixed
     */
    public function attach($request, $id)
    {
        // get the relationship from the URL
        $relationship = $request->segment(count($request->segments()));

        $ids = $request->input($relationship);

        $item = $this->model->find($id);

        // attach the items
        $item->{$relationship}()->sync($ids, false);

        $items = $item->{$relationship}();

        return $items;
    }

    /**
     * Detach items in a many to many relationship
     *
     * @param Request $request
     * @param mixed $id
     *
     * @return mixed
     */
    public function detach($request, $id)
    {
        // get the relationship from the URL
        $relationship = $request->segment(count($request->segments()));

        $ids = $request->input($relationship);

        $item = $this->model->find($id);

        // detach the items
        $item->{$relationship}()->detach($ids);

        return $item;
    }
}
