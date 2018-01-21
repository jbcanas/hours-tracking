<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class EmployeeMasterlistService
{
    public function search(Request $request)
    {
        $result = Employee::search($request->value)->get();

        $result->map(function ($item) {
            $item->resultLabel = $item->first_name. ' ' .$item->last_name;

            return $item;
        });

        return $result;
    }
}
