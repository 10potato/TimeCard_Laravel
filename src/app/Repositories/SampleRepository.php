<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SampleInterface;
use App\Model\Sample;

class SampleRepository implements SampleInterface
{
    public function getAll()
    {
        return Sample::get();
    }

    public function get($id)
    {
        return Sample::find($id);
    }

    public function create($input)
    {
        $dbo = new Sample();

        $dbo->name = $input['name'];
        $dbo->name = $input['address'];
        $dbo->name = $input['sex'];
        $dbo->name = $input['birthday'];
        $dbo->name = $input['phone_number'];

        $dbo->save();

        return $dbo;
    }

    public function update($input, $id)
    {
        $dbo = $this->get($id);

        $dbo->name = $input['name'];
        $dbo->name = $input['address'];
        $dbo->name = $input['sex'];
        $dbo->name = $input['birthday'];
        $dbo->name = $input['phone_number'];

        $dbo->save();

        return $dbo;
    }
}
