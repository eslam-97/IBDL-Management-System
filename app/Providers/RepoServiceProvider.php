<?php

namespace App\Providers;

use App\Repository\Assessment\Category\CategoryRepository;
use App\Repository\Assessment\Category\CategoryRepositoryInterface;
use App\Repository\Assessment\Advice\AdviceRepository;
use App\Repository\Assessment\Advice\AdviceRepositoryInterface;
use App\Repository\Assessment\Company\CompanyRepository;
use App\Repository\Assessment\Company\CompanyRepositoryInterface;
use App\Repository\Assessment\Exam\AssessmentExamRepository;
use App\Repository\Assessment\Exam\AssessmentExamRepositoryInterface;
use App\Repository\Assessment\Position\PositionRepository;
use App\Repository\Assessment\Position\PositionRepositoryInterface;
use App\Repository\Assessment\Statement\StatementRepository;
use App\Repository\Assessment\Statement\StatementRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\AccreditationCenter\AccreditationCenterRepository;
use App\Repository\AccreditationCenter\AccreditationCenterRepositoryInterface;
use App\Repository\AccreditationCenter\AccreditationTrainer\AccreditationTrainerRepository;
use App\Repository\AccreditationCenter\AccreditationTrainer\AccreditationTrainerRepositoryInterface;
use App\Repository\ELearning\Chapter\ChapterRepository;
use App\Repository\ELearning\Chapter\ChapterRepositoryInterface;
use App\Repository\ELearning\ELearningRepository;
use App\Repository\ELearning\ELearningRepositoryInterface;
use App\Repository\Exam\Chapter\ExamChapterRepositoryInterface;
use App\Repository\Exam\Chapter\ExamChapterRepository; 
use App\Repository\Exam\ExamRepository;
use App\Repository\Exam\ExamRepositoryInterface;
use App\Repository\Exam\LiveTracking\LiveTrackingRepository;
use App\Repository\Exam\LiveTracking\LiveTrackingRepositoryInterface;
use App\Repository\Exam\UserExam\UserExamRepository;
use App\Repository\Exam\UserExam\UserExamRepositoryInterface;
use App\Repository\Auth\AuthRepository;
use App\Repository\Auth\AuthRepositoryInterface;
use App\Repository\Corporate\CorporateRepository;
use App\Repository\Corporate\CorporateRepositoryInterface;
use App\Repository\Corporate\Batch\BatchRepository;
use App\Repository\Corporate\Batch\BatchRepositoryInterface;

class RepoServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        $bindings = [
            AccreditationCenterRepositoryInterface::class => AccreditationCenterRepository::class,
            AccreditationTrainerRepositoryInterface::class => AccreditationTrainerRepository::class,
            ELearningRepositoryInterface::class => ELearningRepository::class,
            ChapterRepositoryInterface::class => ChapterRepository::class,
            AuthRepositoryInterface::class => AuthRepository::class,
            CorporateRepositoryInterface::class => CorporateRepository::class,
            BatchRepositoryInterface::class => BatchRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
            AdviceRepositoryInterface::class => AdviceRepository::class,
            PositionRepositoryInterface::class => PositionRepository::class,
            CompanyRepositoryInterface::class => CompanyRepository::class,
            StatementRepositoryInterface::class => StatementRepository::class,
            AssessmentExamRepositoryInterface::class => AssessmentExamRepository::class,
            ExamRepositoryInterface::class => ExamRepository::class, 
            ExamChapterRepositoryInterface::class => ExamChapterRepository::class,
            LiveTrackingRepositoryInterface::class=> LiveTrackingRepository::class,
            UserExamRepositoryInterface::class=> UserExamRepository::class
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}