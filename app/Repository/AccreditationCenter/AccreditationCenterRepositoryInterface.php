<?php

namespace App\Repository\AccreditationCenter;

interface AccreditationCenterRepositoryInterface
{
    public function getAllAccreditationCenter();

    public function StoreAccreditationCenter(array $data);

    public function showAccreditationCenter();

    public function UpdateAccreditationCenter(array $data);

    public function DeleteAccreditationCenter();
}
