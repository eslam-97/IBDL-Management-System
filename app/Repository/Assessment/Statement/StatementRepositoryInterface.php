<?php

namespace App\Repository\Assessment\Statement;

interface StatementRepositoryInterface{

    public function getAllStatements();

    public function StoreStatement(array $data);

    public function showStatement();

    public function updateStatement(array $data);

    public function uploadAssessmentStatement(array $data);

    public function deleteStatement();
}


