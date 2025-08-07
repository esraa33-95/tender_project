<?php

namespace App\Transformers\admin;

use App\Models\MaterialCategory;
use League\Fractal\TransformerAbstract;

class MaterialCategoryTransform extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(MaterialCategory $material):array
    {
        return [
              'id' => $material->id,
              'name_en' => $material->translate('en')?->name,
              'name_ar' => $material->translate('ar')?->name,
              'price'=>$material->price,
              'contractor_percentage'=>$material->contractor_percentage ,
              'image' => $material->getFirstMediaUrl('images') ?: asset('storage/default.png'),
              'added_date'=>$material->added_date,
              'room_property'=>$material->room_property,
        ];
    }
}
