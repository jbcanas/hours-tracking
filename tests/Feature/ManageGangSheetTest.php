<?php

namespace Tests\Feature;

use App\Models\GangSheet;
use App\Models\GangSheetEmployee;
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
        $gangSheet = make(GangSheet::class);
        $gangSheet->employees = factory(GangSheetEmployee::class, 3)->make()->toArray();

        $this->json('POST', '/api/gangSheet/store', $gangSheet->toArray());

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

    /** @test */
    // function can_delete_an_employee_on_the_employees_table()
    // {
    //     create('App\Models\GangSheetEmployee');
    //
    //     $employee = $this->json('POST', '/api/gangSheet/deleteEmployee', [
    //         'id' => 1
    //     ]);
    //
    //     $this->assertNotEmpty($employee->json());
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
