<?php
namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll($paginate);
    public function find($id);
    public function store(array $attributes);
    public function update($id, array $attributes);
    public function destroy($id);
}
