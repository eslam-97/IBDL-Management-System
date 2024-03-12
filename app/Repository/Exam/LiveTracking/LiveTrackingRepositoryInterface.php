<?php

namespace App\Repository\Exam\LiveTracking;

interface LiveTrackingRepositoryInterface{

    public function getAllLiveTrackings();

    public function storeLiveTracking(array $data);

    public function showLiveTracking();

    public function deleteLiveTracking();
}


