<?php

namespace App\Repository\Exam\LiveTracking;

use App\Helpers\XorHelper;
use App\Models\LiveTracking;

class LiveTrackingRepository implements LiveTrackingRepositoryInterface
{
        public function getAllLiveTrackings()
        {
                return LiveTracking::all();
        }

        public function storeLiveTracking(array $data)
        {
                $encryptedData = $this->applyXorEncryption($data);

                $liveTracking = LiveTracking::create($encryptedData);

                return $liveTracking;
        }

        public function showLiveTracking()
        {
                $liveTracking = LiveTracking::findOrFail(request('id'));

                return $liveTracking;
        }

        public function deleteLiveTracking()
        {
                $liveTracking = LiveTracking::where('exam_id', request('id'))->get();

                foreach ($liveTracking as $row) {
                        $row->delete();
                }
        }

        private function applyXorEncryption(array $data)
        {
                $fieldsToEncrypt = ['answer'];

                foreach ($fieldsToEncrypt as $field) {
                        if (isset($data[$field])) {
                                $data[$field] = XorHelper::xor($data[$field]);
                        }
                }

                return $data;
        }
}