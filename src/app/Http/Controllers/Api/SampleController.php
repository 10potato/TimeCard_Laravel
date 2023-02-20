<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SampleController extends Controller
{
    public function __construct()
    {

    }

    /**
     * サンプル GET API
     */
    public function getSample()
    {
        // message
        $message = 'Sample GET API!';

        // 現在時刻
        $now = new Carbon();

        return array(
            'message' => $message,
            'date' => $now,
        );
    }

    public function postSample(Request $request)
    {
        // message
        $message = 'Sample POST API!';

        // POSTパラメータ取得
        $postMessage = $request->input('postMessage');

        // 現在時刻
        $now = new Carbon();

        return array(
            'message' => $message,
            'postMessage' => $postMessage,
            'date' => $now,
        );
    }

}
