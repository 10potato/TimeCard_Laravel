<?php

namespace App\Repositories\Interfaces;

interface SampleInterface
{
    public function getAll();
    public function get($id);
    public function create($input);
    public function update($input, $id);
}
