<?php

namespace App\Repository\Assessment\Exam;

use App\Models\AssessmentExam;
use App\Models\AssessmentStatement;
use App\Repository\Assessment\Exam\AssessmentExamRepositoryInterface;
use Rap2hpoutre\FastExcel\FastExcel;

class AssessmentExamRepository implements AssessmentExamRepositoryInterface
{
    public function getAllExams()
    {
        return AssessmentExam::with('statementOne', 'statementTwo')->get();
    }

    public function storeExam(array $data)
    {
        $exam = AssessmentExam::create($data);

        return $exam;
    }

    public function showExam()
    {
        $exam = AssessmentExam::findOrFail(request('id'));

        return $exam;
    }

    public function updateExam(array $data)
    {
        $exam = AssessmentExam::findOrFail(request('id'));
        $exam->update($data);

        return $exam;
    }

    public function deleteExam()
    {
        $exam = AssessmentExam::findOrFail(request('id'));

        $exam->delete();
    }


    public function uploadAssessmentExam(array $data)
    {
        $file = $data['file'];

        (new FastExcel)->import($file, function ($line) {
            $assessmentStatementOneModel = AssessmentStatement::where('code', $line['statement1_code'])->first();
            $assessmentStatementOne = $assessmentStatementOneModel->getKey();
            $assessmentStatementTwoModel = AssessmentStatement::where('code', $line['statement2_code'])->first();
            $assessmentStatementTwo = $assessmentStatementTwoModel->getKey();

            return AssessmentExam::create([
                'statement_one_id' => $assessmentStatementOne,
                'statement_two_id' => $assessmentStatementTwo
            ]);

        });

    }
}