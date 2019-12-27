<?php


namespace App\Services;


class Types
{
    /**
     * @param $name
     * @return \App\Types
     */
    public function firstOrCreate($name):\App\Types
    {
        return \App\Types::firstOrCreate(['name' => $name]);
    }

}
