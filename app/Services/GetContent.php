<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;
use PHPHtmlParser\Dom;

class GetContent
{
    /**
     * Parse content html to sdtClass
     * @param $url
     * @return \stdClass
     * @throws \PHPHtmlParser\Exceptions\ChildNotFoundException
     * @throws \PHPHtmlParser\Exceptions\CircularException
     * @throws \PHPHtmlParser\Exceptions\CurlException
     * @throws \PHPHtmlParser\Exceptions\NotLoadedException
     * @throws \PHPHtmlParser\Exceptions\StrictException
     */
    public function content($url): \stdClass
    {
        $response = new \stdClass();
        $response->car = new \stdClass();
        $response->template = new \stdClass();
        $content = file_get_contents($url);
        $html = new Dom();
        $html->load($content);
        $info = $html->find('.item-info');
        $response->car->name = $info->find('h1')->text;
        $response->car->price = $info->find('.price')->text;
        $response->template->name = $info->find('.desc')->text;


        $attrList = $info->find('.attr-list')->find('dl');
        $response->car->attributes = $this->getAttributes($attrList);


        $response->car->description = $html->find('.full-content')->find('span')->text;


        $fullFeaturesContent = $html->find('.full-features ')->find('ul');
        $response->car->fullFeaturesContent = $this->getFullFeatures($fullFeaturesContent);

        $breadCrumbs = $html->find('.breadcrumb ')->find('a');
        $response->car->breadCrumbs = $this->getBreadCrumbs($breadCrumbs);


        return $response;
    }

    /**
     * @param Dom\Collection $fullFeaturesContent
     * @return Array
     */
    private function getFullFeatures(Dom\Collection $fullFeaturesContent): Array
    {
        $fullFeatures = [];
        foreach ($fullFeaturesContent as $contents) {

            foreach ($contents as $content) {
                if ($content->tag->name() == 'li') {
                    array_push($fullFeatures, $content->firstChild()->text);
                }
            }
        }
        return $fullFeatures;
    }

    /**
     * @param Dom\Collection $attrList
     * @return Array
     */
    private function getAttributes(Dom\Collection $attrList): Array
    {
        $newAttr = [];
        foreach ($attrList[0] as $attr) {
            if ($attr->tag->name() == 'dt') {
                array_push($newAttr, ['name' => trim($attr->find('text')->text), 'value' => null]);
            } elseif ($attr->tag->name() == 'dd') {
                $child = $attr->firstChild();
                $attributes = $child->getAttributes();
                try {
                    $newAttr[count($newAttr) - 1]['value'] = isset($attributes['content']) ? $attributes['content'] : $child->text;
                } catch (\Exception $e) {
                    Log::error("please check parse content " . $e->getLine() . $e->getMessage());
                } catch (\Throwable $e) {
                    echo "Caught exception of class: " . get_class($e) . PHP_EOL;
                }
            }
        }
        return $newAttr;
    }

    private function getBreadCrumbs(Dom\Collection $attrList): Array
    {
        $list = [];
        foreach ($attrList as $item) {
            array_push($list, trim($item->firstChild()->text));
        }
        return $list;
    }


}
