<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $paginate;

    public function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel();
    public function setModel()
    {

        $this->model = app()->make(
            $this->getModel()

        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPaginate($paginate)
    {
        return $this->model->paginate($paginate);
    }

    public function find($id)
    {
        return $this->model->findOrfail($id);
    }

    public function store($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result->update($attributes);
        }
        return false;
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}
