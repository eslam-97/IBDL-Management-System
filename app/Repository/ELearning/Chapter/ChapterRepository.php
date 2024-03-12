<?php

namespace App\Repository\ELearning\Chapter;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\XorHelper;
use App\Models\Chapter;


class ChapterRepository implements ChapterRepositoryInterface
{

    public function getAllChapter()
    {
        return Chapter::all(); // Retrieve all Chapters records
    }

    public function StoreChapter(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $chapter = Chapter::create($encryptedData);

        // Attach the authenticated user to the new ELearning record in the pivot table
        $chapter->user()->attach($chapter, [
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'user_id' => $data['user_id'],
        ]);
        return $chapter;
    }

    public function UpdateChapter(array $data)
    {
        // Apply XOR encryption to specific fields
        $encryptedData = $this->applyXorEncryption($data);

        $chapter = Chapter::findOrFail(request('id'));

        // Attach the authenticated user to the new ELearning record in the pivot table
        $chapter->user()->attach($chapter, [
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'user_id' => $data['user_id'],
        ]);

        $chapter->update($encryptedData);

        return $chapter;
    }


    public function DeleteChapter()
    {
        $chapter = Chapter::findOrFail(request('id'));

        $chapter->delete();
    }

    public function showChapter()
    {
        $chapter = Chapter::findOrFail(request('id'));

        return $chapter;
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