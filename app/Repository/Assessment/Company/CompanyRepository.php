<?php

namespace App\Repository\Assessment\Company;

use App\Helpers\XorHelper;
use App\Models\AssessmentCompany;
use App\Repository\Assessment\Company\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAllCompanys()
    {
        return AssessmentCompany::all();
    }

    public function storeCompany(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $company = AssessmentCompany::create($encryptedData);

        return $company;
    }

    public function showCompany()
    {
        $company = AssessmentCompany::findOrFail(request('id'));

        return $company;
    }

    public function updateCompany(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $company = AssessmentCompany::findOrFail(request('id'));

        $company->update($encryptedData);

        return $company;
    }

    public function deleteCompany()
    {
        $company = AssessmentCompany::findOrFail(request('id'));

        $company->delete();
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