<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Car $car
     * @return Car
     */
    public function show(Car $car)
    {
        return $car;
    }

    /**
     * @param Request $request
     * @param \App\Services\Car $carServices
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Response|\Illuminate\Support\Collection
     */
    public function search(Request $request, \App\Services\Car $carServices)
    {

        $validator = Validator::make($request->all(), [
            'filter.by_brand' => 'sometimes|exists:brands,id',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }
        try {
            return $carServices->search($request);
        } catch (\Exception $e) {
            return response($e->getMessage(), 422);
        }


    }
}
