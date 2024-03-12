<?php

namespace App\Repository\Assessment\Company;

interface CompanyRepositoryInterface{

    public function getAllCompanys();

    public function StoreCompany(array $data);

    public function showCompany();

    public function updateCompany(array $data);

    public function deleteCompany();
}


