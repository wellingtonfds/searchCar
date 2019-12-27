<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $casts = [
        'accessories' => 'array'
    ];

    protected $fillable = [
        'version', 'year', 'model', 'gearbox', 'doors', 'gas','descriptions',
        'license_plate', 'accessories', 'price', 'exchange', 'template_id'
    ];

    public function template()
    {
        $this->belongsTo(Template::class);
    }
}
