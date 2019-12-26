<?php


namespace App\Services;


use PHPHtmlParser\Dom;

class GetContent
{
    public function content($url){
        $content = file_get_contents($url);
        $html = new Dom();
        $html->load($content);
        $info = $html->find('.item-info');
        dd($info->find('h1')->text);
    }

}
