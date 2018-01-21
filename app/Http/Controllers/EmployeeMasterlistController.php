<?php


namespace App\Http\Controllers;


use App\Services\EmployeeMasterlistService;
use Illuminate\Http\Request;

class EmployeeMasterlistController extends Controller
{
    protected $employeeMasterlistService;

    public function __construct(EmployeeMasterlistService $employeeMasterlistService)
    {
        $this->employeeMasterlistService = $employeeMasterlistService;
    }

    public function search(Request $request)
    {
        return $this->employeeMasterlistService->search($request);
    }
}