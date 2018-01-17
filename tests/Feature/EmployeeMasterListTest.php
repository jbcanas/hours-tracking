<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EmployeeMasterListTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;
    
    /** @test */
    public function can_search_an_employee()
    {
        create('App\Models\Employee', [], 20);

        $employee = $this->json('POST', '/api/masterList/search', [
            'value' => 'bak'
        ]);

        $employee->assertSuccessful($employee->json());
    }
}
