<?php

namespace App\Repository\Assessment\Advice;

interface AdviceRepositoryInterface{

    public function getAllAdvices();

    public function StoreAdvice(array $data);

    public function showAdvice();

    public function updateAdvice(array $data);

    public function uploadAssessmentAdvice(array $data);

    public function deleteAdvice();
}


