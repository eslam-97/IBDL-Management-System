<?php

namespace App\Repository\AccreditationCenter\AccreditationTrainer;

interface AccreditationTrainerRepositoryInterface
{
    public function getAllAccreditationTrainer();

    public function StoreAccreditationTrainer(array $data);

    public function showAccreditationTrainer();

    public function UpdateAccreditationTrainer(array $data);

    public function DeleteAccreditationTrainer();
}
