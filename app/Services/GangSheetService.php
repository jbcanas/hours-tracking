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

            $employee->gang_sheet_id = $gangSheet->id;
            $employee->employee_id = $employeeData['employee_id'];
            $employee->ilwu_number = $employeeData['ilwu_number'];
            $employee->company_number = $employeeData['company_number'];
            $employee->job_position = $employeeData['job_position'];
            $employee->registration_status = $employeeData['registration_status'];

            $employee->st = $employeeData['st'];
            $employee->ot = $employeeData['ot'];
            $employee->pot = $employeeData['pot'];
            $employee->dt = $employeeData['dt'];

            if(env('COMPANY') == 'apl') {
                $employee->st_other = $employeeData['st_other'];
                $employee->ot_other = $employeeData['ot_other'];
                $employee->pot_other = $employeeData['pot_other'];
            } else {
                $employee->office_use = $employeeData['office_use'];
                $employee->labor_code = $employeeData['labor_code'];
                $employee->adjust_pay = $employeeData['adjust_pay'];
            }

            $employee->save();
        }

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
