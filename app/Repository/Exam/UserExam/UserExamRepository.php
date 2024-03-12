<?php

namespace App\Repository\Exam\UserExam;

use App\Helpers\XorHelper;
use App\Http\Controllers\Exam\LiveTracking\LiveTrackingController;
use App\Models\UserExam;

class UserExamRepository implements UserExamRepositoryInterface
{
    public function getAllUserExams()
    {
        return UserExam::all();
    }

    public function storeUserExam(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $userExam = UserExam::create($encryptedData);

        return $userExam;
    }


    public function updateUserExam(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $userExam = UserExam::update($encryptedData);

        return $userExam;
    }

    public function showUserExam()
    {
        $userExam = UserExam::findOrFail(request('id'));

        return $userExam;
    }

    public function deleteUserExam()
    {
        $userExam = UserExam::where('user_id', request('id'));

        $userExam->delete();
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['result'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}