<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    // テーブル名
    protected $table = 'holiday';
    // 主キー
    protected $primaryKey = 'id';

    // 日付 日数差の計算や経過日数などに便利 6/9
    protected $dates = [
        'add_date',
        'paid_start',
        'paid_end',
    ];


}
