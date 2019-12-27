<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name','brand_id','type_id'];

    public function brand(){
        return $this->belongsTo(Brands::class);
    }

    public function type(){
        return $this->belongsTo(Types::class);
    }
}

