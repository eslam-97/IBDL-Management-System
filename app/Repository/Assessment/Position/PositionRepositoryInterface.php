<?php

namespace App\Repository\Assessment\Position;

interface PositionRepositoryInterface{

    public function getAllPositions();

    public function StorePosition(array $data);

    public function showPosition();

    public function updatePosition(array $data);

    public function deletePosition();
}


