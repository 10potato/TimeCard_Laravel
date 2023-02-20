<?php

namespace App\Repositories\Interfaces;

interface HolidayInterface
{
    // 休暇申請データ全件取得
    public function getAll();

    // 休暇データ取得
    public function get($id);

    // 休暇データ更新
    public function update($input, $id);

    // 休暇データ登録
    public function add($input);

    // 休暇データを削除
    public function delete($id);

}
