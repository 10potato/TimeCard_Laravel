<?php
namespace App\Eloquent;

use Illuminate\Foundation\Auth\User as Authenticatable; 

class MUser extends Authenticatable
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'm_user';

    /**
     * テーブルの主キー
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 配列に含めない属性
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}