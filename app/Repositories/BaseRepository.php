<?php
namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements  RepositoryInterface
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
    public function getAll($paginate)
    {
        return $this->model->paginate($paginate);
    }
    public function find($id)
    {
        return $this->model->findOrfail($id);
    }
    public function store(array $attributes)
    {
        return $this->model->create($attributes);

    }
    public function update($id, array $attributes)
    {
        $results = $this->find($id);
        if($results){
            $results->update($attributes);
            return $results;
        }
        return false;
    }
    public function destroy($id)
    {
        $results = $this->find($id);
        if($results){
            $results->delete();
            return $results;
        }
        return false;
    }
}