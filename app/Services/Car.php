<?php


namespace App\Services;

use App\Car as CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as CollectionAlias;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Car
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|CollectionAlias
     */
    public function search(Request $request)
    {
        return QueryBuilder::for(CarModel::class)
            ->allowedFilters([
                'year', 'doors', 'gas', 'price', 'template_id', 'license_plate',
                AllowedFilter::scope('year_bigger_then'),
                AllowedFilter::scope('year_less_then'),
                AllowedFilter::scope('model_bigger_then'),
                AllowedFilter::scope('model_less_then'),
                AllowedFilter::scope('by_brand'),
                AllowedFilter::scope('price_bigger_then'),
                AllowedFilter::scope('price_less_then'),
            ])->get();
    }
}
