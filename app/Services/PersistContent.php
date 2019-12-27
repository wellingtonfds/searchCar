<?php


namespace App\Services;


use App\Car;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PersistContent
{
    /**
     * Persist content of site seminovosbh
     * @param \stdClass $content
     */
    public function persist(\stdClass $content): void
    {

        //Type
        $typeServices = new Types();
        $type = $typeServices->firstOrCreate($content->car->breadCrumbs[1]);

        //Brand
        $brandService = new Brands();
        $brand = $brandService->firstOrCreate($content->car->breadCrumbs[2]);


        //Template
        $templateService = new Templates();
        $template = $templateService->firstOrCreate($type, $brand, $content->car->breadCrumbs[3]);

        //Car
        Car::create([
            'version' => $content->template->name,
            'year' => $this->getYear($content->car->attributes[0]['value']),
            'model' => $this->getModelYear($content->car->attributes[0]['value']),
            'gearbox' => $content->car->attributes[2]['value'],
            'doors' => $content->car->attributes[3]['value'],
            'gas' => $content->car->attributes[4]['value'],
            'license_plate' => $content->car->attributes[6]['value'],
            'accessories' => $content->car->fullFeaturesContent,
            'descriptions' => $content->car->description,
            'price' => floatval(preg_replace('/[^\d\.]/', '', $content->car->price)),
            'template_id' => $template->id,
            'exchange' => $content->car->attributes[7]['value'],

        ]);
    }

    /**
     * @param $data
     * @return Carbon
     * @throws \Exception
     */
    private function getYear($data)
    {
        $data = explode('/', $data);
        return new Carbon('first day of December '.Arr::first($data));
    }

    /**
     * @param $data
     * @return Carbon
     * @throws \Exception
     */
    private function getModelYear($data)
    {
        $data = explode('/', $data);
        if (isset($data[1])) {
            return new Carbon('first day of December '.$data[1]);
        }
        return new Carbon('first day of December '.Arr::first($data));
    }

}
