<?php

namespace App\Repository\ELearning;

use App\Helpers\XorHelper;
use App\Models\ELearning;
use App\Repository\ELearning\ELearningRepositoryInterface;

class ELearningRepository implements ELearningRepositoryInterface
{

    public function getAllELearning()
    {
        return ELearning::all(); 
    }

    public function StoreELearning(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $eLearning = ELearning::create($encryptedData);

        // Attach the authenticated user to the new ELearning record in the pivot table
        $eLearning->user()->attach($eLearning, [
            'language_id' => $data['language_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'finished' => $data['finished'],
            'user_id' => $data['user_id'],
        ]);

        return $eLearning;
    }


    public function UpdateELearning(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $eLearning = ELearning::findOrFail(request('id'));

        $eLearning->update($encryptedData);

        $userRelationshipData = [
            'language_id' => $data['language_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'finished' => $data['finished'],
        ];

        // Update the pivot table data for the user relationship
        $eLearning->user()->updateExistingPivot($data['user_id'], $userRelationshipData);


        return $eLearning;
    }

    public function DeleteELearning()
    {
        $eLearning = ELearning::findOrFail(request('id'));

        $eLearning->delete();
    }

    public function showELearning()
    {
        $eLearning = ELearning::findOrFail(request('id'));

        return $eLearning;
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['name', 'instruction', 'logo'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}

