<?php
namespace App\Repositories\Interfaces;

interface DepartRepositoriesInterface
{
    public function getAllDepart();
    public function getDepartbyId($departId);
    public function deleteDepart($departId);
    public function createDepart(array $departDetails);
    public function updateDepart($departId , array $newDetails);
}