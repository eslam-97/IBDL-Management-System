<?php

namespace App\Repository\Corporate;

interface CorporateRepositoryInterface
{

    // Get All Corporate
    public function getAllCorporates();

    // Store Corporate
    public function StoreCorporate(array $data);

    // Update Corporate
    public function UpdateCorporate(array $data);
    
    // Show Corporate
    public function showCorporate();

    // Delete Corporate
    public function DeleteCorporate();

}
