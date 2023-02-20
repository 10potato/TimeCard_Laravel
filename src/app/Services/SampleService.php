<?php
namespace App\Services;

use App\Repositories\Interfaces\SampleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleService
{
    protected $sampleRepo;
    
    public function __construct(
        SampleInterface $sampleInterface
    )
    {
        $this->sampleRepo = $sampleInterface;
    }

    /**
     * サンプルデータ全件取得
     * @return Array サンプルデータ全件
     */
    public function getAll()
    {
        return $this->sampleRepo->getAll();
    }

    /**
     * サンプルデータ取得
     * 
     * @param Integer $id ID
     * @return Array サンプルデータ
     */
    public function getHolidayData($id)
    {
        return $this->sampleRepo->get($id);
    }

    /**
     * サンプルデータ登録
     * @param Request $request POSTデータ
     */
    public function add(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $input = array(
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'sex' => $request->input('sex'),
                'birthday' => $request->input('birthday'),
                'phone_number' => $request->input('phone_number'),
            );

            $this->sampleRepo->create($input);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * サンプルデータ更新
     * @param Request $request POSTデータ
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $id = $request->input('id');

            $input = array(
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'sex' => $request->input('sex'),
                'birthday' => $request->input('birthday'),
                'phone_number' => $request->input('phone_number'),
            );

            $this->sampleRepo->update($input, $id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
