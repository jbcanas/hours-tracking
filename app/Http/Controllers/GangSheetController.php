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

    public function find(Request $request)
    {
        return $this->gangSheetService->find($request);
    }

    public function deleteEmployee(Request $request)
    {
        return $this->gangSheetService->deleteEmployee($request);
    }

    public function mechTemplate(Request $request)
    {
        return $this->gangSheetService->mechTemplate($request);
    }
}
