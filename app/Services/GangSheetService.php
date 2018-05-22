<?php

namespace App\Services;

use App\Models\GangSheet;
use App\Models\GangSheetEmployee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class GangSheetService
{
    public function store(Request $request)
    {
        $jobSheetNumber = "";
        $company = env("COMPANY") == "apl" ? "APL" : "HL";
        $searchJsn = GangSheet::orderBy('id', 'desc')
            ->orderBy('job_sheet_number', 'desc')
            ->first();

        if(!empty($searchJsn)) {
            $matchedJsn = substr($searchJsn->job_sheet_number, strlen($company));
            $length = strlen($matchedJsn) < 3 ? 3 : strlen($matchedJsn);
            $jobSheetNumber = $company. str_pad($matchedJsn + 1, $length, 0, STR_PAD_LEFT);
        } else {
            $jobSheetNumber = $company. '001';
        }

        $gangSheet = ! empty(GangSheet::find($request->id)) ? GangSheet::find($request->id) : new GangSheet;
        $gangSheet->user_id = /*$request->user_id*/ 0;
        $gangSheet->account_description = $request->accountDescription;
        $gangSheet->job_name = $request->jobName;
        $gangSheet->ilwu_job_number = $request->ilwuJobNumber;
        $gangSheet->work_date = Carbon::parse($request->workDate);
        $gangSheet->dispatch_date = Carbon::parse($request->dispatchDate);
        $gangSheet->dispatch_by = $request->requestedBy;
        $gangSheet->job_location = $request->jobLocation;
        $gangSheet->vessel_barge = $request->vesselBarge;
        $gangSheet->start_time = $request->startTime;
        $gangSheet->stop_time = $request->stopTime;
        $gangSheet->moves = $request->moves;
        $gangSheet->gang = $request->gang;
        $gangSheet->voyage = $request->voyage;
        $gangSheet->notes = $request->notes;
        $gangSheet->coffee_break = $request->coffeeBreak;
        $gangSheet->meal_break = $request->mealBreak;
        $gangSheet->early_start = $request->earlyStart;
        $gangSheet->arbitrary_award = $request->arbitrationAward;

        if($request->id == 0) $gangSheet->job_sheet_number = $jobSheetNumber;

        $gangSheet->save();

        foreach ($request->employees as $employeeData) {
            $rowid = isset($employeeData['id']) ? $employeeData['id'] : 0;
            $employee = $rowid > 0 ? GangSheetEmployee::find($employeeData['id']) : new GangSheetEmployee;

            $employee->driverhour_id = $gangSheet->id;
            $employee->employee_id = $employeeData['employee_id'];
            $employee->employee_number = $employeeData['employee_number'];
            $employee->company_number = $employeeData['company_number'];
            $employee->first_name = $employeeData['first_name'];
            $employee->last_name = $employeeData['last_name'];
            $employee->job_position = $employeeData['job_position'];
            $employee->reg_status = $employeeData['reg_status'];

            $employee->st = $employeeData['st']['value'];
            $employee->ot = $employeeData['ot']['value'];
            $employee->pot = $employeeData['pot']['value'];
            $employee->dt = $employeeData['dt']['value'];

            if(env('COMPANY') == 'apl') {
                $employee->st_other = $employeeData['st_other']['value'];
                $employee->ot_other = $employeeData['ot_other']['value'];
                $employee->pot_other = $employeeData['pot_other']['value'];
            } else {
                $employee->office_use = $employeeData['office_use']['value'];
                $employee->labor_code = $employeeData['labor_code']['value'];
                $employee->adjust_pay = $employeeData['adjust_pay']['value'];
            }

            $employee->save();
        }

        $gangSheet->employees = $gangSheet->employees;

        return $gangSheet;
    }

    public function delete(Request $request)
    {
        if(! $request->has('id')) return 0;

        $gangSheet = GangSheet::find($request->id);

        if(empty($gangSheet)) return 0;

        $gangSheet->delete();
    }

    public function find(Request $request)
    {
        if(! $request->has('type') || ! $request->has('value')) return 0;

        $gangSheet = GangSheet::where($request->type, $request->value)->first();
        $gangSheet->employees = GangSheetEmployee::where("driverhour_id", $gangSheet->id)->get();

        $gangSheet->employees->map(function ($item) {
            $item->st += 0;
            $item->st_other += 0;
            $item->ot += 0;
            $item->ot_other += 0;
            $item->pot += 0;
            $item->pot_other += 0;
            $item->dt += 0;

            return $item;
        });

        return $gangSheet;
    }

    public function deleteEmployee(Request $request)
    {
        if(! $request->has('id')) return 0;

        $employee = GangSheetEmployee::find($request->id);
        $employee->delete();

        return 'deleted';
    }
}
