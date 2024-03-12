<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const Admin = 'admin';

    const ELearningAdmin = 'elearning_admin';

    const CorporateCenter = 'corporate_center';

    const Trinee = 'trinee';
    
    const Batch = 'batch';

    const AccreditationTrainer = 'accreditation_trainer';
    
    const AccreditationCenter = 'accreditation_center';
    
    const AssessmentAdmin = 'assessment';
}