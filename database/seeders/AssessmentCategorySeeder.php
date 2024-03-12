<?php

namespace Database\Seeders;

use App\Models\AssessmentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssessmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Followership',
                'category_code' => 'F',
                'detail' => 'need to support authority',
                'score' => '4',
            ],
            [
                'name' => 'G',
                'category_code' => 'G',
                'detail' => 'need for rules and supervision',
                'score' => '4', 
            ],
            [
                'name' => 'Work Direction',
                'category_code' => 'H',
                'detail' => 'need to finish a task',
                'score' => '0', 
            ],
            [
                'name' => 'I',
                'category_code' => 'I',
                'detail' => 'role of hard intense worker',
                'score' => '5', 
            ],
            [
                'name' => 'J',
                'category_code' => 'J',
                'detail' => 'need to achieve',
                'score' => '0', 
            ],
            [
                'name' => 'Leadership',
                'category_code' => 'K',
                'detail' => 'leadership role',
                'score' => '3', 
            ],
            [
                'name' => 'L',
                'category_code' => 'L',
                'detail' => 'need to control others',
                'score' => '8', 
            ],
            [
                'name' => 'M',
                'category_code' => 'M',
                'detail' => 'ease in decision making',
                'score' => '20', 
            ],
            [
                'name' => 'Activity',
                'category_code' => 'N',
                'detail' => 'pace',
                'score' => '6', 
            ],
            [
                'name' => 'O',
                'category_code' => '0',
                'detail' => 'vigorous type',
                'score' => '5', 
            ],
            [
                'name' => 'Social Nature',
                'category_code' => 'P',
                'detail' => 'need to be noticed',
                'score' => '3', 
            ],
            [
                'name' => 'Q',
                'category_code' => 'Q',
                'detail' => 'social extension',
                'score' => '0', 
            ],
            [
                'name' => 'R',
                'category_code' => 'R',
                'detail' => 'need to belong to groups',
                'score' => '6', 
            ],
            
            [
                'name' => 'S',
                'category_code' => 'S',
                'detail' => 'need for closness and affaction',
                'score' => '1', 
            ],
            [
                'name' => 'Work Style',
                'category_code' => 'T',
                'detail' => 'theoretical type',
                'score' => '2', 
            ],
            [
                'name' => 'U',
                'category_code' => 'U',
                'detail' => 'interest in working with details',
                'score' => '0', 
            ],
            [
                'name' => 'V',
                'category_code' => 'V',
                'detail' => 'organised type',
                'score' => '2', 
            ],
            [
                'name' => 'Temperament',
                'category_code' => 'W',
                'detail' => 'need for change',
                'score' => '5', 
            ],
            [
                'name' => 'X',
                'category_code' => 'X',
                'detail' => 'Emotional restraint',
                'score' => '6', 
            ],
            [
                'name' => 'Y',
                'category_code' => 'Y',
                'detail' => 'Need to be forceful',
                'score' => '20', 
            ],
        ];

        foreach ($categories as $category) {
            $category['language_id'] = 1;
            AssessmentCategory::create($category);
        }
    }
}
