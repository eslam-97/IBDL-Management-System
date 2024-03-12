<?php

namespace App\Repository\Assessment;

interface AssessmentRepositoryInterface
{

    public function getAllAssessments();

    public function StoreAssessment(array $data);

    public function UpdateAssessment(array $data);
    
    public function showAssessment();

    public function DeleteAssessment();

}
