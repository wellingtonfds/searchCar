<?php


namespace App\Services;


class Brands
{
    /**
     * @param $name
     * @return mixed
     */
    public function firstOrCreate($name)
    {
        return \App\Brands::firstOrCreate(['name' => $name]);
    }

}
