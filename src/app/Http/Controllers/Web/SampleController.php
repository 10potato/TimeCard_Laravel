<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\SampleService;

class SampleController extends Controller
{
    protected $sampleService;

    public function __construct(
        SampleService $sampleService
    )
    {
        $this->sampleService = $sampleService;
    }

    public function index()
    {
        // タイトル
        $title = 'サンプル画面';

        // サンプルメッセージ
        $sampleMessage = 'コントローラーで設定した文字列';

        // TODO サンプルデータを取得する
        $sampleData = $this->sampleService->getAll();

        return view('sample.index', compact('title','sampleMessage','sampleData'));
    }

}
