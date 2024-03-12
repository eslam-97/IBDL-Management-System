<?php

namespace App\Repository\ELearning;

interface ELearningRepositoryInterface
{
    public function getAllELearning();

    public function StoreELearning(array $data);

    public function ShowELearning();

    public function UpdateELearning(array $data);

    public function DeleteELearning();
}
