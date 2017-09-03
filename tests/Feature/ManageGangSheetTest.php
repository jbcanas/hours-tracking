<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageGangSheetTest extends TestCase
{
    /** @test */
    function canCreateAGangSheet()
    {
        $response = $this->post('/gangSheet/create', [
            
        ]);
    }
}
