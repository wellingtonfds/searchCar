<?php


namespace App\Services;


use Spatie\Crawler\Crawler;
use App\Observers\GetCarObserver;


class CrawlerCarBrands
{

    private $brands = [
        'Audi', 'BMW', 'Chevrolet', 'Citroen', 'Fiat', 'Ford', 'Hyundai', 'Honda', 'Jeep', 'Renault', 'Toyota', 'Volkswagen',
        'Mercedes Benz'
    ];

    public function crawler():void
    {
        foreach ($this->brands as $brand){
            $brand = str_replace(' ', '-',$brand);
            Crawler::create()
                ->addCrawlObserver(new GetCarObserver($brand))
                ->setMaximumDepth(1)
                ->startCrawling("https://seminovos.com.br/carro/$brand");
        }
    }

}
