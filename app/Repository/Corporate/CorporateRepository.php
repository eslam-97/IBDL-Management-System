<?php

namespace App\Repository\Corporate;

use App\Enums\UserRole;
use App\Helpers\XorHelper;
use App\Models\Corporate;
use App\Services\Contracts\User\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CorporateRepository implements CorporateRepositoryInterface
{

    public function __construct(protected UserServiceInterface $userService)
    {
    }

    public function getAllCorporates()
    {
        return Corporate::all();
    }

    public function storeCorporate(array $data)
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
          $this->userService->create($userData, UserRole::CorporateCenter);
  
          // Create a new Corporate record with the encrypted data
          $corporate = Corporate::create($encryptedData);
  
          return $corporate;
    }

    public function updateCorporate(array $data)
    {

        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);


        $corporate = Corporate::findOrFail(request('id'));


        $corporate->update($encryptedData);

        return $corporate;
    }

    public function ShowCorporate()
    {

        $corporate = Corporate::findOrFail(request('id'));

        return $corporate;
    }

    public function deleteCorporate()
    {
        $corporate = Corporate::findOrFail(request('id'));

        $corporate->delete();
    }
    
    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['email', 'phone', 'contact_email', 'contact_phone','website'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }

    public function register(array $data): Model
    {
        return $this->userService->create(Arr::only($data, [
            'email',
            'name',
            'password',
        ]), UserRole::CorporateCenter);
    }
}