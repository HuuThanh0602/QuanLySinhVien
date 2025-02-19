<?php
namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements  RepositoryInterface
{
    protected $model;

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
        return $this->model->whereNull('deleted_at')->paginate(10);
    }
    public function find($id)
    {
        return $this->model->find($id);
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
            $results->update(['deleted_at'=>now()]);
            return $results;
        }
        return false;
    }
}