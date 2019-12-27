<?php


namespace App\Services;


class Brands
{

    public function firstOrCreate($name){
        return \App\Brands::firstOrCreate(['name'=>$name]);
    }

}
