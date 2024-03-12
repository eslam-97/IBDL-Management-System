<?php

namespace App\Repository\Assessment\Statement;

use App\Helpers\XorHelper;
use App\Models\AssessmentStatement;
use App\Models\AssessmentCategory;
use App\Repository\Assessment\Statement\StatementRepositoryInterface;
use Rap2hpoutre\FastExcel\FastExcel;

class StatementRepository implements StatementRepositoryInterface
{
    public function getAllStatements()
    {
        return AssessmentStatement::all();
    }

    public function storeStatement(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);
        $Statement = AssessmentStatement::create($encryptedData);

        return $Statement;
    }

    public function showStatement()
    {
        $Statement = AssessmentStatement::findOrFail(request('id'));

        return $Statement;
    }

    public function updateStatement(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);
        $Statement = AssessmentStatement::findOrFail(request('id'));
        $Statement->update($encryptedData);

        return $Statement;
    }

    public function deleteStatement()
    {
        $Statement = AssessmentStatement::findOrFail(request('id'));

        $Statement->delete();
    }

    public function uploadAssessmentStatement(array $data)
    {
        $file = $data['file'];

        (new FastExcel)->import($file, function ($line) {
            $assessmentCategory = AssessmentCategory::where('category_code', $line['code'])->first();

            return AssessmentStatement::create([
                'assessment_category_id' => $assessmentCategory->id,
                'code' => $line['unique_code'],
                'statement' => XorHelper::xor($line['statement']),
                'value' => $line['value']
            ]);
        });

    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['statement','code','value'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}