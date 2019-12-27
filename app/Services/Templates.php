<?php

namespace App\Services;

use \App\Template;
use \App\Types;
use \App\Brands;


class Templates
{

    /**
     * @param Types $types
     * @param Brands $brands
     * @param $name
     * @return Template
     */
    public function firstOrCreate(Types $types, Brands $brands, $name): Template
    {
        $template = Template::where('brand_id', $brands->id)
            ->where('type_id', $types->id)
            ->where('name', $name)
            ->first();

        if (empty($template)) {
            $template = Template::create([
                'brand_id' => $brands->id, 'type_id' => $types->id, 'name' => $name
            ]);
        }
        return $template;

    }

}
