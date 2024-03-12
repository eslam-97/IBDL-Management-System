<?php

namespace App\Repository\Assessment\Advice;

use App\Helpers\XorHelper;
use App\Models\AssessmentAdvice;
use App\Models\AssessmentCategory;
use App\Repository\Assessment\Advice\AdviceRepositoryInterface;
use Rap2hpoutre\FastExcel\FastExcel;

class AdviceRepository implements AdviceRepositoryInterface
{
    public function getAllAdvices()
    {
        return AssessmentAdvice::all();
    }

    public function storeAdvice(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $Advice = AssessmentAdvice::create($encryptedData);

        return $Advice;
    }

    public function showAdvice()
    {
        $Advice = AssessmentAdvice::findOrFail(request('id'));

        return $Advice;
    }

    public function updateAdvice(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $Advice = AssessmentAdvice::findOrFail(request('id'));

        $Advice->update($encryptedData);

        return $Advice;
    }

    public function deleteAdvice()
    {
        $Advice = AssessmentAdvice::findOrFail(request('id'));

        $Advice->delete();
    }

    public function uploadAssessmentAdvice(array $data)
    {
        $file = $data['file'];
        $header = (new FastExcel)->withoutHeaders()->import($file)->first();

        $columnHeaders = array_slice($header, 1, 3);

        foreach ($columnHeaders as $rangeValue) {
            (new FastExcel)->import($file, function ($line) use ($rangeValue) {
                $assessmentCategory = AssessmentCategory::where('category_code', $line['category_code'])->first();
                $line = $this->applyXorEncryption($line);

                return AssessmentAdvice::create([
                    'assessment_category_id' => $assessmentCategory->id,
                    'language_id' => $line['language_id'],
                    'range_value' => XorHelper::xor($rangeValue),
                    'advice' => XorHelper::xor($line[$rangeValue]),
                    'advice_if_high_candidate' => XorHelper::xor($line['advices if high candidate']),
                    'advice_if_low_candidate' => XorHelper::xor($line['advices if low candidate']),
                    'advice_if_high_boss' => XorHelper::xor($line['advices if high boss']),
                    'advice_if_low_boss' => XorHelper::xor($line['advices if low boss'])
                ]);

            });
        }
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['range_value', 'advice', 'advice_if_high_candidate', 'advice_if_low_candidate', 'advice_if_high_boss', 'advice_if_low_boss'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}