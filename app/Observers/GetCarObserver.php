<?php


namespace App\Observers;


use App\Services\GetContent;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObserver;

class GetCarObserver extends CrawlObserver
{
    /**
     * Exclude words
     */
    private $excludes = [
        'comparar','revendas','planos-de-anuncio','anuncie','faq','noticias','carro','quem-somos','publicidade',
        'politicas-de-privacidade','detrans','contato','termo-de-responsabilidade','/'
    ];

    /**
     * Check this uri is valid
     * @param String $uri
     * @return bool
     */
    private function validUri($uri){
        foreach ($this->excludes as $exclude){
            if(strpos($uri, $exclude)){
                return  false;
            }
        }
        return true;
    }


    /**
     * @inheritDoc
     */
    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null)
    {
        if($url->getHost() == 'seminovos.com.br' &&  $url->__toString() != 'https://seminovos.com.br/'){
            if($this->validUri($url->getPath()) && $url->__toString() != null){
                $getContent = new GetContent();
                $getContent->content($url->__toString());
                exit();
            }


        }


    }

    /**
     * @inheritDoc
     */
    public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null)
    {
        //dd($url, $requestException, $foundOnUrl);
    }

}
