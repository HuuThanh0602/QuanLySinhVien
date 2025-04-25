<?php

namespace App\Repositories\Student;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function storeStudent($attribute);
    public function search($paginate, $attribute);
    public function age($attribute);
    public function prefix($attribute);
    public function destroyStudent($id);
    public function destroyYearOld();
}
