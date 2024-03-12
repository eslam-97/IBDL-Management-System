<?php

namespace App\Repository\Exam\Chapter;

interface ExamChapterRepositoryInterface{

    public function getAllChapters();

    public function StoreChapter(array $data);

    public function ShowChapter();

    public function UpdateChapter(array $data);

    public function DeleteChapter();

}


