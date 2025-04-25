<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();
    public function getPaginate($paginate);
    public function find($id);
    public function store($attributes);
    public function update($id, $attributes);
    public function destroy($id);
}
