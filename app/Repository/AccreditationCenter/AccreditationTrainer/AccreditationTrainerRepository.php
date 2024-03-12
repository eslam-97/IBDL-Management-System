<?php

namespace App\Repository\AccreditationCenter\AccreditationTrainer;

use App\Enums\UserRole;
use App\Helpers\XorHelper;
use App\Models\AccreditationTrainer;
use App\Services\Contracts\User\UserServiceInterface;




class AccreditationTrainerRepository implements AccreditationTrainerRepositoryInterface
{

    public function __construct(protected UserServiceInterface $userService)
    {
    }

    public function getAllAccreditationTrainer()
    {
        return AccreditationTrainer::all(); // Retrieve all AccreditationTrainer records
    }

    public function storeAccreditationTrainer(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        // Extract the necessary data for user registration
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => 'default_password_here',
        ];

        // Register the corporate user
        $this->userService->create($userData, UserRole::AccreditationTrainer);

        // Create a new Corporate record with the encrypted data
        $accreditationTrainer = AccreditationTrainer::create($encryptedData);

        return $accreditationTrainer;
    }

    public function showAccreditationTrainer()
    {
        $accreditationTrainer = AccreditationTrainer::findOrFail(request('id'));

        return $accreditationTrainer;
    }

    public function updateAccreditationTrainer(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $accreditationTrainer = AccreditationTrainer::findOrFail(request('id'));

        $accreditationTrainer->update($encryptedData);

        return $accreditationTrainer;
    }

    public function deleteAccreditationTrainer()
    {
        $accreditationTrainer = AccreditationTrainer::findOrFail(request('id'));
        $accreditationTrainer->delete();
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['email', 'phone', 'website', 'company', 'training_field', 'training_hours'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}