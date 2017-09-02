<?php

namespace Tests\Feature;

use App\Models\GangSheet;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageGangSheetTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_create_a_gang_sheet()
    {
        $gangSheet = GangSheet::create([
            'account_description' => 'BARGE',
            'job_name' => 'BARGE',
            'requested_by' => 'Bryan',
            'arbitration_award' => false,
            'request_date' => Carbon::create(),
            'vessel_barge' => '',
            'work_date' => '',
            'voyage' => '',
            'start_time' => '',
            'job_sheet_number' => '',
            'stop_time' => '',
            'ilwu_job_number' => '',
            'meal_break' => '',
            'notes' => '',
            'coffee_break' => '',
            'early_start' => '',
            'moves' => '',
            'gang' => '',
            'employees' => '',
        ]);

        $this->assertNotEmpty($gangSheet);
    }
}
