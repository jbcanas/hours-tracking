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
        $response = $this->json('POST', '/api/gangSheet/store', [
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
            'arbitrary_award' => 0
        ]);

        $response
            ->assertJson([
                'user_id' => 1
            ]);
    }

    /** @test */
    function can_delete_a_gang_sheet()
    {
        $gangSheet = factory('App\Models\GangSheet')->create();

        $this->json('POST', '/api/gangSheet/delete', ['id' => $gangSheet->id]);

        $this->assertEquals(null, GangSheet::where('id', $gangSheet->id));
    }
}
