<?php
namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();
    public function getPaginate($paginate);
    public function find($id);
    public function store(array $attributes);
    public function update($id, array $attributes);
    public function destroy($id);
}
