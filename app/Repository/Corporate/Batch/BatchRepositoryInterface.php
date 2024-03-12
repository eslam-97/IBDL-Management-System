<?php

namespace App\Repository\Corporate\Batch;

interface BatchRepositoryInterface{

    // Get All Batch
    public function getAllBatchs();

    // Store Batch
    public function StoreBatch(array $data);

    // Show Batch
    public function showBatch();

    // Update Batch
    public function updateBatch(array $data);

    // Delete Batch
    public function deleteBatch();

}


