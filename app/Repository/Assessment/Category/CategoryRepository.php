<?php

namespace App\Repository\Assessment\Category;

use App\Helpers\XorHelper;
use App\Models\AssessmentCategory;
use App\Repository\Assessment\Category\CategoryRepositoryInterface;
use Rap2hpoutre\FastExcel\FastExcel;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategorys()
    {
        return AssessmentCategory::all();
    }

    public function storeCategory(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);
        $category = AssessmentCategory::create($encryptedData);

        return $category;
    }

    public function showCategory()
    {
        $category = AssessmentCategory::findOrFail(request('id'));

        return $category;
    }

    public function updateCategory(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);
        $category = AssessmentCategory::findOrFail(request('id'));
        $category->update($encryptedData);

        return $category;
    }

    public function deleteCategory()
    {
        $category = AssessmentCategory::findOrFail(request('id'));
        $category->delete();
    }

    public function uploadAssessmentCategory(array $data)
    {
        $file = $data['file'];

        // Read the contents of the file using FastExcel
        $importedData = (new FastExcel)->import($file);

        // Create AssessmentCategory records with encrypted data
        foreach ($importedData as $line) {
            // Apply XOR encryption to specific fields
            $line = $this->applyXorEncryption($line);

            AssessmentCategory::create([
                'language_id' => $line['language_id'],
                'name' => $line['name'],
                'category_code' => $line['category_code'],
                'detail' => $line['detail'],
                'score' => $line['score']
            ]);
        }
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['name', 'detail', 'score'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}