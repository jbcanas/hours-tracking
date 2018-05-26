<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TomLingham\Searchy\Facades\Searchy;


class EmployeeMasterlistService
{
    public function search(Request $request)
    {
        $result = Searchy::search('Employees')
        ->fields('first_name', 'last_name')
        ->query($request->value)
        ->get();

        $result->map(function ($item) {
            $item->resultLabel = $item->first_name. ' ' .$item->last_name;
            $item->reg_status = $item->status;

            return $item;
        });

        return $result;
    }
}
