<?php

namespace App\Services;

use App\Models\GangSheet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;


class GangSheetService
{
    public function store(Request $request)
    {
        $gangSheet = $request->has('id') ? GangSheet::find($request->id) : new GangSheet;
        $gangSheet->user_id = $request->user_id;
        $gangSheet->account_description = $request->account_description;
        $gangSheet->job_name = $request->job_name;
        $gangSheet->job_sheet_number = $request->job_sheet_number;
        $gangSheet->ilwu_job_number = $request->ilwu_job_number;
        $gangSheet->work_date = Carbon::parse($request->work_date);
        $gangSheet->dispatch_by = 'Bryan';
        $gangSheet->job_location = 'APL';
        $gangSheet->vessel_barge = '';
        $gangSheet->start_time = '';
        $gangSheet->stop_time = '';
        $gangSheet->moves = 0;
        $gangSheet->gang = 0;
        $gangSheet->voyage = 0;
        $gangSheet->notes = '';
        $gangSheet->dispatch_date = Carbon::parse($request->dispatch_date);
        $gangSheet->coffee_break = 0;
        $gangSheet->meal_break = 0;
        $gangSheet->early_start = 0;
        $gangSheet->arbitrary_award = 0;

        $gangSheet->save();

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
        if(! $request->has('job_sheet_number') || ! $request->has('ilwu_job_number')) return 0;

        $searchValue = $request->has('job_sheet_number') ? $request->job_sheet_number : $request->ilwu_job_number;
        $gangSheet = GangSheet::where('')
    }
}
