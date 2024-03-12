<?php

namespace App\Repository\Exam;

interface ExamRepositoryInterface{

    public function getAllExams();

    public function storeExam(array $data);

    public function showExam();
    
    public function updateExam(array $data);

    public function uploadExamData(array $data);

    public function deleteExam();

}


