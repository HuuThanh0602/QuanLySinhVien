<?php

namespace App\Repositories\Result;

use App\Repositories\RepositoryInterface;

interface ResultRepositoryInterface extends RepositoryInterface
{
    public function getSubjectLearned($id);
    public function register($attribute);
    public function getResult();
    public function enterScore($score);
    public function importExcel($fileExcel);
    public function updateScore();
}
