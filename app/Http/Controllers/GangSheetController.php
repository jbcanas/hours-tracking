<?php

namespace App\Http\Controllers;

use App\Services\GangSheetService;
use Illuminate\Http\Request;

class GangSheetController extends Controller
{
    private $gangSheetService;

    function __construct(GangSheetService $gangSheetService)
    {
        $this->gangSheetService = $gangSheetService;
    }

    public function store(Request $request)
    {
        return $this->gangSheetService->store($request);
    }

    public function delete(Request $request)
    {
        return $this->gangSheetService->delete($request);
    }
}
