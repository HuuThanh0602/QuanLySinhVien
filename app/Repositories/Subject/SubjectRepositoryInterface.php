<?php

namespace App\Repositories\Subject;

use App\Repositories\RepositoryInterface;

interface SubjectRepositoryInterface extends RepositoryInterface
{
    public function getSubjectWithStatus();
    public function destroySubject($id);
    public function getSubjectNotStudied($studentId);
}
