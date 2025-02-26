<?php
namespace App\Repositories\Student;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function search($paginate,$attribute);
    public function age_from($attribute);
    public function age_to($attribute);
    public function prefix($attribute);
}