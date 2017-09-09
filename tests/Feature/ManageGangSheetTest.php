<?php

namespace Tests\Feature;

use App\Models\GangSheet;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ManageGangSheetTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    /** @test */
    function can_create_a_gang_sheet()
    {
        $this->json('POST', '/api/gangSheet/store', [
            'user_id' => 1,
            'account_description' => 'BARGE',
            'job_name' => 'BARGE',
            'job_sheet_number' => 'APL001',
            'ilwu_job_number' => 'A17-001',
            'work_date' => Carbon::now()->format('Y-m-d'),
            'dispatch_by' => 'Bryan',
            'job_location' => 'APL',
            'vessel_barge' => '',
            'start_time' => '',
            'stop_time' => '',
            'moves' => 0,
            'gang' => 0,
            'voyage' => 0,
            'notes' => '',
            'dispatch_date' => Carbon::now()->format('Y-m-d'),
            'coffee_break' => 0,
            'meal_break' => 0,
            'early_start' => 0,
            'arbitrary_award' => 0,
            'employees' => [
                [
                    'employee_id' => 123,
                    'ilwu_number' => 1000,
                    'company_number' => 1000,
                ]
            ]
        ]);

        $this->assertFalse(GangSheet::all()->isEmpty());
    }

    /** @test */
    function can_delete_a_gang_sheet()
    {
        $gangSheet = create('App\Models\GangSheet');

        $this->json('POST', '/api/gangSheet/delete', ['id' => $gangSheet->id]);

        $this->assertEquals(null, GangSheet::find($gangSheet->id));
    }

    /** @test */
    function can_update_a_gang_sheet()
    {
        $gangSheet = create('App\Models\GangSheet');

        // expected value
        $expectedValue = [
            'account_description' => 'ROAD DRIVING',
            'job_name' => 'ROAD DRIVING'
        ];

        $gangSheet->account_description = $expectedValue['account_description'];
        $gangSheet->job_name = $expectedValue['job_name'];

        $this->json('POST', '/api/gangSheet/store', $gangSheet->toArray());

        $updatedGangSheet = GangSheet::find($gangSheet->id);

        $this->assertEquals($expectedValue['account_description'], $updatedGangSheet->account_description);
        $this->assertEquals($expectedValue['job_name'], $updatedGangSheet->job_name);
    }

    /** @test */
    function can_find_a_gang_sheet_by_job_sheet_number()
    {
        create('App\Models\GangSheet');

        $gangSheet = $this->json('POST', '/api/gangSheet/find', [
            'type' => 'job_sheet_number',
            'value' => 'APL001'
        ]);

        $this->assertArraySubset([
            'account_description' => 'BARGE',
            'job_sheet_number' => 'APL001'
        ], $gangSheet->json());
    }

    /** @test */
    function can_find_a_gang_sheet_by_ilwu_job_number()
    {
        create('App\Models\GangSheet');

        $gangSheet = $this->json('POST', '/api/gangSheet/find', [
            'type' => 'ilwu_job_number',
            'value' => 'A17-001'
        ]);

        $this->assertArraySubset([
            'account_description' => 'BARGE',
            'ilwu_job_number' => 'A17-001'
        ], $gangSheet->json());
    }

    // /** @test */
    // function can_delete_an_employee_on_the_employees_table()
    // {
    //
    // }

    // /** @test */
    // function can_add_an_employee_to_the_employees_table()
    // {
    //
    // }

    // /** @test */
    // function can_export_to_excel()
    // {
    //
    // }

    // /** @test */
    // function can_export_timesheet_pdf()
    // {
    //
    // }

    // /** @test */
    // function can_export_dispatch_list_pdf()
    // {
    //
    // }
}
