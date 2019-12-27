<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Car extends Model
{

    protected $with = ['template.type', 'template.brand'];

    protected $casts = [
        'accessories' => 'array'
    ];

    protected $fillable = [
        'version', 'year', 'model', 'gearbox', 'doors', 'gas', 'descriptions',
        'license_plate', 'accessories', 'price', 'exchange', 'template_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * @param Builder $query
     * @param  $year
     * @return Builder
     * @throws \Exception
     */
    public function scopeYearBiggerThen(Builder $query, $year)
    {
        $year = new Carbon("first day of December $year");
        return $query->where('year', '>=', $year);
    }

    /**
     * @param Builder $query
     * @param $year
     * @return Builder
     * @throws \Exception
     */
    public function scopeYearLessThen(Builder $query, $year)
    {
        $year = new Carbon("first day of December $year");
        return $query->where('year', '<=', $year);
    }

    /**
     * @param Builder $query
     * @param $year
     * @return Builder
     * @throws \Exception
     */
    public function scopeModelBiggerThen(Builder $query, $year)
    {
        $year = new Carbon("first day of December $year");
        return $query->where('model', '>=', $year);
    }

    /**
     * @param Builder $query
     * @param $year
     * @return Builder
     * @throws \Exception
     */
    public function scopeModelLessThen(Builder $query, $year)
    {
        $year = new Carbon("first day of December $year");
        return $query->where('model', '<=', $year);
    }

    /**
     * @param Builder $query
     * @param $brand
     * @return Builder
     */
    public function scopeByBrand(Builder $query, $brand)
    {
        return $query->whereHas('template', function (Builder $query) use ($brand) {
            return $query->where('brand_id', $brand);
        });
    }

    /**
     * @param Builder $query
     * @param $price
     * @return Builder
     */
    public function scopePriceBiggerThen(Builder $query, $price)
    {
        return $query->where('price', '>=', $price);
    }

    /**
     * @param Builder $query
     * @param $price
     * @return Builder
     */
    public function scopePriceLessThen(Builder $query, $price)
    {
        return $query->where('price', '<=', $price);
    }


}
