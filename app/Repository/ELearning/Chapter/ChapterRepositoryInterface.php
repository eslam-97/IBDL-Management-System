<?php

namespace App\Repository\ELearning\Chapter;

interface ChapterRepositoryInterface
{

    // get all Chapter
    public function getAllChapter();

    // Store Chapter
    public function StoreChapter(array $data);

    // Show Chapter
    public function ShowChapter();

    // Update Chapter
    public function UpdateChapter(array $data);

    // Delete Chapter
    public function DeleteChapter();
}
