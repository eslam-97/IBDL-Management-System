<?php

namespace App\Repository\Corporate\Batch;

use App\Enums\UserRole;
use App\Helpers\XorHelper;
use App\Models\Batch;
use App\Services\Contracts\User\UserServiceInterface;

class BatchRepository implements BatchRepositoryInterface
{
    public function __construct(protected UserServiceInterface $userService)
    {
    }
 
    public function getAllBatchs()
    {
        return Batch::all();
    }

    public function storeBatch(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $batch = Batch::create($encryptedData);


        // Extract the necessary data for user registration
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => 'default_password_here',
        ];

        // Register the corporate user
        $this->userService->create($userData, UserRole::Batch);


        return $batch;
    }

    public function showBatch()
    {

        $batch = Batch::findOrFail(request('id'));

        return $batch;

    }

    public function updateBatch(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $batch = Batch::findOrFail(request('id'));

        $batch->update($encryptedData);

        return $batch;
    }

    public function deleteBatch()
    {
        $batch = Batch::findOrFail(request('id'));

        $batch->delete();
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['name', 'success_rate','email'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}