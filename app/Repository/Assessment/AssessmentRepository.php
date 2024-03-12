<?php

namespace App\Repository\Assessment;

use App\Enums\UserRole;
use App\Helpers\XorHelper;
use App\Models\Assessment;
use App\Services\Contracts\User\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AssessmentRepository implements AssessmentRepositoryInterface
{

    public function __construct(protected UserServiceInterface $userService)
    {
    }

    public function getAllAssessments()
    {
        return Assessment::all();
    }

    public function storeAssessment(array $data)
    {

          // Apply XOR encryption to specific fields
          $encryptedData = $this->applyXorEncryption($data);

          // Extract the necessary data for user registration
          $userData = [
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => 'default_password_here',
          ];
  
          // Register the Assessment user
          $this->userService->create($userData, UserRole::AssessmentCenter);
  
          // Create a new Assessment record with the encrypted data
          $Assessment = Assessment::create($encryptedData);
  
          return $Assessment;
    }

    public function updateAssessment(array $data)
    {

        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);


        $Assessment = Assessment::findOrFail(request('id'));


        $Assessment->update($encryptedData);

        return $Assessment;
    }

    public function ShowAssessment()
    {

        $Assessment = Assessment::findOrFail(request('id'));

        return $Assessment;
    }

    public function deleteAssessment()
    {
        $Assessment = Assessment::findOrFail(request('id'));

        $Assessment->delete();
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
        ]), UserRole::AssessmentCenter);
    }
}