<?php

use App\Models\GangSheetEmployee;
use Faker\Generator as Faker;

$factory->define(App\Models\GangSheet::class, function (Faker $faker) {
    return [
        'id' => 1,
        'user_id' => 1,
        'account_description' => 'BARGE',
        'job_name' => 'BARGE',
        'job_sheet_number' => 'APL001',
        'ilwu_job_number' => 'A17-001',
        'work_date' => $faker->date('Y-m-d'),
        'dispatch_by' => 'Bryan',
        'job_location' => 'APL',
        'vessel_barge' => '',
        'start_time' => '',
        'stop_time' => '',
        'moves' => 0,
        'gang' => 0,
        'voyage' => 0,
        'notes' => '',
        'dispatch_date' => $faker->date('Y-m-d'),
        'coffee_break' => 0,
        'meal_break' => 0,
        'early_start' => 0,
        'arbitrary_award' => 0
    ];
});
