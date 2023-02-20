<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HolidayService;
use Illuminate\Support\Carbon;
use App\Http\Requests\HolidayFormRequest;

class HolidayController extends Controller
{
    protected $holidayService;

    public function __construct(

        HolidayService $holidayService

    ) {
        $this->holidayService = $holidayService;
    }

    // 休日データ登録
    public function add(HolidayFormRequest $request)
    {
        $this->holidayService->add($request, true);
    }

    // 休日データ更新
    public function update(HolidayFormRequest $request)
    {
        $this->holidayService->update($request, true);
    }

    // 休日データ削除
    public function delete(Request $request)
    {
        $this->holidayService->delete($request);
    }

}
