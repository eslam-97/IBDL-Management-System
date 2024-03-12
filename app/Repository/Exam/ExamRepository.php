<?php

namespace App\Repository\Exam;

use App\Helpers\XorHelper;
use App\Models\Exam;
use Rap2hpoutre\FastExcel\FastExcel;

class ExamRepository implements ExamRepositoryInterface
{

    public function getAllExams()
    {
        return exam::with('examData')->get();
    }

    public function StoreExam(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $exam = Exam::create($encryptedData);

        $exam->examData()->create($data);
    }

    public function showExam()
    {
        $exam = Exam::with('examData')->findOrFail(request('id'));

        return $exam;
    }

    public function updateExam(array $data)
    {
        $encryptedData = $this->applyXorEncryption($data);

        $exam = Exam::with('examData')->findOrFail(request('id'));

        $exam->update($encryptedData);

        $exam->examData()->update([$data['data']]);


        return $exam;
    }

    public function deleteExam()
    {
        $exam = Exam::findOrFail(request('id'));

        $exam->examData()->delete();

        $exam->delete();
    }

    public function uploadExamData(array $data)
    {
        $file = $data['file'];

        $exam_id = $data['exam_id'];

        (new FastExcel)->import($file, function ($line) use ($exam_id) {
            $exam = Exam::find($exam_id);

            $encryptedData = XorHelper::xor(json_encode([
                'id' => $line['id'],
                'question' => $line['question'],
                'ans1' => $line['ans1'],
                'ans2' => $line['ans2'],
                'ans3' => $line['ans3'],
                'ans4' => $line['ans4'],
                'ans5' => $line['ans5'],
                'right_ans' => $line['right_ans'],
                'lang' => $line['lang'],
                'difficulty' => $line['difficulty'],
                'level' => $line['level'],
                'chapter' => $line['chapter']
            ]));

            return $exam->examData()->create([
                'data' => $encryptedData
            ]);
        });
    }

    private function applyXorEncryption(array $data)
    {
        $fieldsToEncrypt = ['instructions', 'name'];

        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field]) && is_string($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}