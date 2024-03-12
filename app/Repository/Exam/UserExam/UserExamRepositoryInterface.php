<?php

namespace App\Repository\Exam\UserExam;

interface UserExamRepositoryInterface{

    public function getAllUserExams();

    public function storeUserExam(array $data);

    public function updateUserExam(array $data);

    public function showUserExam();

    public function deleteUserExam();
}


