<?php

namespace App\Services;

use App\Models\AccountDescription;
use App\Models\JobName;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;


class GangSheetService {

	public function index(Request $request)
	{
		return [
			'accountDescriptions' => AccountDescription::all(),
			'jobNames' => JobName::all(),
		];
	}
}