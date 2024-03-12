<?php

namespace App\Repository\Assessment\Exam;

interface AssessmentExamRepositoryInterface{

    public function getAllExams();

    public function StoreExam(array $data);

    public function showExam();

    public function updateExam(array $data);

    public function uploadAssessmentExam(array $data);

    public function deleteExam();
}


