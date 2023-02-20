<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    protected $holidayService;

    public function __construct(
        HolidayService $holidayService
    )
    {
        $this->holidayService = $holidayService;
    }

    /**
     * ホーム申請データリスト
     */
    public function index()
    {
        // タイトル
        $title = '休暇情報一覧';
        // 休暇データを全取得取得する
        $holidayData = $this->holidayService->getAll();
        $holidayData = json_encode($holidayData);
 
        return view('holiday.index', compact('title','holidayData'));
    }


    public function add()
    {
        // タイトル
        $title = '休暇申請';
        // 空のデータ
        $holidayData = array();
        $updateFlag = 0;
 
        return view('holiday.form', compact('title', 'updateFlag'));
    }

    public function update($holidayId)
    {
        // タイトル
        $title = '休暇データ更新';

        $updateFlag = 1;

        // 休暇データを取得する
        $holidayData = $this->holidayService->get($holidayId);
        $holidayData = json_encode($holidayData);

        logger($holidayData);
 
        return view('holiday.update', compact('title', 'holidayData', 'updateFlag'));
    }

}
