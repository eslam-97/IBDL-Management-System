<?php

namespace App\Repository\Assessment\Category;

interface CategoryRepositoryInterface{

    public function getAllCategorys();

    public function StoreCategory(array $data);

    public function showCategory();

    public function updateCategory(array $data);

    public function uploadAssessmentCategory(array $data);

    public function deleteCategory();
}


