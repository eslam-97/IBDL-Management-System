<?php

namespace App\Repository\AccreditationCenter;

use App\Enums\UserRole;
use App\Helpers\XorHelper;
use App\Models\AccreditationCenter;
use App\Services\Contracts\User\UserServiceInterface;




class AccreditationCenterRepository implements AccreditationCenterRepositoryInterface
{

    public function __construct(protected UserServiceInterface $userService)
    {
    }

    public function getAllAccreditationCenter()
    {
        return AccreditationCenter::all(); // Retrieve all AccreditationCenter records
    }

    public function storeAccreditationCenter(array $data)
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
        $this->userService->create($userData, UserRole::AccreditationCenter);

        // Create a new Corporate record with the encrypted data
        $accreditationCenter = AccreditationCenter::create($encryptedData);

        return $accreditationCenter;
    }

    public function showAccreditationCenter()
    {
        $accreditationCenter = AccreditationCenter::findOrFail(request('id'));

        return $accreditationCenter;
    }

    public function updateAccreditationCenter(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $accreditationCenter = AccreditationCenter::findOrFail(request('id'));

        $accreditationCenter->update($encryptedData);

        return $accreditationCenter;
    }

    public function deleteAccreditationCenter()
    {
        $accreditationCenter = AccreditationCenter::findOrFail(request('id'));

        $accreditationCenter->delete();
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['email', 'phone', 'accreditation', 'approve', 'comm_req', 'contact_email', 'contact_phone'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }


}