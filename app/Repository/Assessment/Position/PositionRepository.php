<?php

namespace App\Repository\Assessment\Position;

use App\Helpers\XorHelper;
use App\Models\AssessmentPosition;
use App\Repository\Assessment\Position\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{
    public function getAllPositions()
    {
        return AssessmentPosition::all();
    }

    public function storePosition(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $position = AssessmentPosition::create($encryptedData);

        return $position;
    }

    public function showPosition()
    {
        $position = AssessmentPosition::findOrFail(request('id'));

        return $position;
    }

    public function updatePosition(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $position = AssessmentPosition::findOrFail(request('id'));

        $position->update($encryptedData);

        return $position;
    }

    public function deletePosition()
    {
        $position = AssessmentPosition::findOrFail(request('id'));

        $position->delete();
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['name'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}