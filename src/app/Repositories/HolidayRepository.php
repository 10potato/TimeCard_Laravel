<?php

namespace App\Repositories;

use App\Repositories\Interfaces\HolidayInterface;
use App\Model\Holiday;

class HolidayRepository implements HolidayInterface
{
    public function createEntity()
    {
        return new Holiday();
    }

    /**
     * 全ての申請データを取得する
     *
     * @return Collection
     */
    public function getAll()
    {
        return Holiday::get();
    }

    /**
     * 指定した申請データを取得する
     *
     * @param Integer $id 申請ID
     * @return Collection 休暇申請データ
     */
    public function get($id)
    {
        return Holiday::find($id);
    }

    /**
     * 申請データを新規登録する
     *
     * @param array $input 入力項目 
     * @return Collection
     */
    public function add($input)
    {
        $dbo = $this->createEntity();

        $dbo->status_no = $input['status_no'];
        $dbo->add_date = $input['add_date'];
        $dbo->staff_name = $input['staff_name'];
        $dbo->section = $input['section'];
        $dbo->memo = $input['memo'];
        $dbo->paid_start = $input['paid_start'];
        $dbo->paid_end = $input['paid_end'];
        $dbo->tel = $input['tel'];
        $dbo->holiday_type = $input['holiday_type'];
        $dbo->paid_type = $input['paid_type'];

        $dbo->save();

        return $dbo;
    }


    /**
     * 申請データを更新する
     * 
     * @param array $input 入力項目
     * @param Integer $id 申請ID
     * @return Collection
     */
    public function update($input, $id)
    {
        $dbo = $this->get($id);

        $dbo->status_no = $input['status_no'];
        $dbo->add_date = $input['add_date'];
        $dbo->staff_name = $input['staff_name'];
        $dbo->section = $input['section'];
        $dbo->memo = $input['memo'];
        $dbo->paid_start = $input['paid_start'];
        $dbo->paid_end = $input['paid_end'];
        $dbo->tel = $input['tel'];
        $dbo->holiday_type = $input['holiday_type'];
        $dbo->paid_type = $input['paid_type'];

        $dbo->save();

        return $dbo;
    }

    /**
     * 指定した申請データを削除する
     * 
     * @param Integer $id 申請ID
     * @return void
     */
    public function delete($id)
    {
        $dbo = $this->get($id);
        $dbo->delete();

        return $dbo;
    }

}
