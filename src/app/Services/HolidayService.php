<?php
namespace App\Services;

use App\Repositories\Interfaces\HolidayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HolidayFormRequest;

class HolidayService
{
    protected $holidayRepo;
    
    public function __construct(
        HolidayInterface $holidayInterface
    )
    {
        $this->holidayRepo = $holidayInterface;
    }

    /**
     * 休暇申請データ全件取得
     * @return Array 休暇データ全件
     */
    public function getAll()
    {
        return $this->holidayRepo->getAll();
    }

    /**
     * 休暇データ取得
     * 
     * @param Integer $id ID
     * @return Array 休暇申請データ
     */
    public function get($id)
    {
        return $this->holidayRepo->get($id);
    }

    /**
     * 休暇データ登録
     * 
     * @param Request $request POSTデータ
     */
    public function add(HolidayFormRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $input = array(
                'status_no' => $request->input('status_no'),
                'add_date' => $request->input('add_date'),
                'staff_name' => $request->input('staff_name'),
                'section' => $request->input('section'),
                'memo' => $request->input('memo'),
                'paid_start' => $request->input('paid_start'),
                'paid_end' => $request->input('paid_end'),
                'tel' => $request->input('tel'),
                'holiday_type' => $request->input('holiday_type'),
                'paid_type' => $request->input('paid_type'),
            );

            $this->holidayRepo->add($input);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * 休暇データ更新
     * 
     * @param Request $request POSTデータ
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $id = $request->input('id');

            $input = array(
                'status_no' => $request->input('status_no'),
                'add_date' => $request->input('add_date'),
                'staff_name' => $request->input('staff_name'),
                'section' => $request->input('section'),
                'memo' => $request->input('memo'),
                'paid_start' => $request->input('paid_start'),
                'paid_end' => $request->input('paid_end'),
                'tel' => $request->input('tel'),
                'holiday_type' => $request->input('holiday_type'),
                'paid_type' => $request->input('paid_type'),
            );

            $this->holidayRepo->update($input, $id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * 休暇データ削除
     * 
     * @param Integer $id 申請ID
     */
    public function delete($request)
    {
        $input = array(
            'id' => $request->input('id'),
        );
        $this->holidayRepo->delete($input['id']);
    }


}
