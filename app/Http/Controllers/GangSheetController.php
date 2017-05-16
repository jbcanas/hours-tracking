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

    public function index(Request $request)
    {
    	return $this->gangSheetService->index($request);
    }
}
