<?php

namespace App\Repository\Exam\Chapter;

use App\Helpers\XorHelper;
use App\Models\ExamChapter;

class ExamChapterRepository implements ExamChapterRepositoryInterface
{

    public function getAllChapters()
    {
        return ExamChapter::all();
    }

    public function StoreChapter(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $chapter = ExamChapter::create($encryptedData);

        return $chapter;
    }

    public function showChapter()
    {
        $chapter = ExamChapter::findOrFail(request('id'));

        return $chapter;
    }

    public function updateChapter(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $chapter = ExamChapter::findOrFail(request('id'));

        $chapter->update($encryptedData);
    }

    public function DeleteChapter()
    {
        $chapter = ExamChapter::findOrFail(request('id'));

        $chapter->delete();
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['chapter'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}